<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Client\TicketHttpClientProvider;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\DTO\ReserveDTO;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\Exceptions\FailedToEventBookSeatsAdapterException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use Illuminate\Support\Facades\Log;

/**
 * Реализация адаптера для бронирования мест на событие
 */
final readonly class EventBookSeatsAdapter implements EventBookSeatsAdapterInterface
{
    public function __construct(
        private TicketHttpClientProvider $httpClientProvider,
        private Translator $translator,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function reserve(int $eventId, string $name, array $placeIds): ReserveDTO
    {
        try {
            $client = $this->httpClientProvider->getClient();
            $client->withHeader('Authorization', $this->getToken());
            $response = $client->asForm()->post(
                url: $this->geUrl($eventId),
                data: [
                    'name' => $name,
                    'places' => $placeIds,
                ]
            );
        } catch (\Throwable $exception) {
            throw new NetworkException(
                message: 'Сетевая ошибка при работе адаптера забронировать места события',
                previous: $exception
            );
        }

        if ($response->failed()) {
            $message = 'Недопустимый статус ответа от API билетного шлюза забронировать места события';
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

        $data = $response->json();

        try {
            if (array_key_exists('error', $data)) {
                throw new FailedToEventBookSeatsAdapterException(
                    message: $data['error'],
                );
            }

            $result = $this->translator->transform($data);

        } catch (\Throwable $exception) {
            $message = 'Ошибка преобразования ответа от API билетного шлюза забронировать места события';
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
        return sprintf('events/%d/reserve', $eventId);
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
