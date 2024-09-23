<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\EventBookSeats;

use App\Ticket\Application\Services\EventBookSeats\DTO\EventBookSeatsResponseDTO;
use App\Ticket\Application\Services\EventBookSeats\DTO\ReserveResponseDTO;
use App\Ticket\Application\Services\EventBookSeats\Exceptions\FailedToEventBookSeatsException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\DTO\ReserveDTO;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\EventBookSeatsAdapterInterface;

/**
 * Реализация службы для бронирования мест на событие
 */
final readonly class EventBookSeatsService implements EventBookSeatsServiceInterface
{
    public function __construct(
        private EventBookSeatsAdapterInterface $eventBookSeatsAdapter
    ) {}

    /**
     * {@inheritDoc}
     */
    public function reserve(int $eventId, string $name, array $placeIds): EventBookSeatsResponseDTO
    {
        try {
            return $this->mapperEventBookSeatsDTO(
                reserveDTO: $this->eventBookSeatsAdapter->reserve(
                    eventId: $eventId,
                    name: $name,
                    placeIds: $placeIds
                )
            );
        } catch (\Throwable $exception) {
            throw new FailedToEventBookSeatsException(
                message: 'Ошибка при бронировании мест на событие',
                code: 0,
                previous: $exception
            );
        }
    }

    private function mapperEventBookSeatsDTO(ReserveDTO $reserveDTO): EventBookSeatsResponseDTO
    {
        return new EventBookSeatsResponseDTO(
            response: new ReserveResponseDTO(
                reservation_id: $reserveDTO->reservation_id,
                success: $reserveDTO->success,
            )
        );
    }
}
