<?php

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats;

use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\DTO\ReserveDTO;

/**
 * Интерфейс адаптера для бронирования мест на событие
 */
interface EventBookSeatsAdapterInterface
{
    /**
     * Забронировать места события
     */
    public function reserve(int $eventId, string $name, array $placeIds): ReserveDTO;
}
