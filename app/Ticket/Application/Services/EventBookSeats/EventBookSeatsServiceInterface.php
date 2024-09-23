<?php

namespace App\Ticket\Application\Services\EventBookSeats;

use App\Ticket\Application\Services\EventBookSeats\DTO\EventBookSeatsResponseDTO;
use App\Ticket\Application\Services\GetEventPlaces\Exceptions\FailedToEventBookSeatsException;

/**
 * Интерфейс службы для бронирования мест на событие
 */
interface EventBookSeatsServiceInterface
{
    /**
     * Получения списка мест события
     *
     * @throws FailedToEventBookSeatsException
     */
    public function reserve(int $eventId, string $name, array $placeIds): EventBookSeatsResponseDTO;
}
