<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Client\TicketHttpClientProvider;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Реализация адаптера для получения списка мест события
 */
final readonly class GetEventPlacesAdapter implements GetEventPlacesAdapterInterface
{
    public function __construct(
        private TicketHttpClientProvider $httpClientProvider,
        private Translator $translator,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function get(int $eventId): Collection
    {
        try {
            $client = $this->httpClientProvider->getClient();
            $client->withHeader('Authorization', $this->getToken());
            $response = $client->get($this->geUrl($eventId));

        } catch (\Throwable $exception) {
            throw new NetworkException(
                message: 'Сетевая ошибка при работе адаптера получения списка мест события',
                previous: $exception
            );
        }

        if ($response->failed()) {
            $message = 'Недопустимый статус ответа от API билетного шлюза получения списка мест события';
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
            $message = 'Ошибка преобразования ответа от API билетного шлюза получения списка мест события';
            if ($this->getIsDebug()) {
                Log::error($message, [
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
    private function geUrl(int $eventId): string
    {
        return sprintf('events/%d/places', $eventId);
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
