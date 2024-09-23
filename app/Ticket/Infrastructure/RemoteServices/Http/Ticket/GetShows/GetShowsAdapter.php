<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Client\TicketHttpClientProvider;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Реализация адаптера для получения списка мероприятий
 */
final readonly class GetShowsAdapter implements GetShowsAdapterInterface
{
    public function __construct(
        private TicketHttpClientProvider $httpClientProvider,
        private Translator $translator,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function get(): Collection
    {
        try {
            $client = $this->httpClientProvider->getClient();
            $client->withHeader('Authorization', $this->getToken());
            $response = $client->get($this->geUrl());

        } catch (\Throwable $exception) {
            throw new NetworkException(
                message: 'Сетевая ошибка при работе адаптера получения списка мероприятий',
                previous: $exception
            );
        }

        if ($response->failed()) {
            $message = 'Недопустимый статус ответа от API билетного шлюза получения списка мероприятий';
            if ($this->getIsDebug()) {
                Log::error(
                    $message,
                    [
                        'response_body' => $response->json(),
                        'status_code' => $response->status(),
                    ],
                );
            }

            throw new AdapterException(
                message: $message,
            );
        }

        try {
            $result = $this->translator->transform($response->json());
        } catch (\Throwable $exception) {
            $message = 'Ошибка преобразования ответа от API билетного шлюза получения списка мероприятий';
            if ($this->getIsDebug()) {
                Log::error('Ошибка преобразования ответа от API билетного шлюза получения списка мероприятий', [
                    'response' => $response->body(),
                    'error_message' => $exception->getMessage(),
                ]);
            }
            throw new AdapterException(
                message: $message,
                code: 0,
                previous: $exception
            );
        }

        return $result;

    }

    /**
     * Получить url запроса.
     */
    private function geUrl(): string
    {
        return 'shows';
    }

    /**
     * Получить token запроса.
     */
    private function getToken(): string
    {
        return 'Bearer '.config('gateway.services.ticket.token');
    }

    private function getIsDebug(): bool
    {
        return config('gateway.services.ticket.debug');
    }
}
