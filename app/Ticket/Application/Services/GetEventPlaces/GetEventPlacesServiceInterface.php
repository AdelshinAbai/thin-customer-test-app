<?php

namespace App\Ticket\Application\Services\GetEventPlaces;

use App\Ticket\Application\Services\GetEventPlaces\DTO\PlacesResponseDTO;
use App\Ticket\Application\Services\GetEventPlaces\Exceptions\FailedToGetEventPlacesException;

/**
 * Интерфейс службы для получения списка мест события
 */
interface GetEventPlacesServiceInterface
{
    /**
     * Получения списка мест события
     *
     * @throws FailedToGetEventPlacesException
     */
    public function get(int $eventId): PlacesResponseDTO;
}
