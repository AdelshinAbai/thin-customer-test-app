<?php

namespace App\Ticket\Application\Services\GetShowEvents;

use App\Ticket\Application\Services\GetShowEvents\DTO\EventsResponseDTO;
use App\Ticket\Application\Services\GetShowEvents\Exceptions\FailedToGetShowEventsException;

/**
 * Интерфейс службы для получения списка событий мероприятия
 */
interface GetShowEventsServiceInterface
{
    /**
     * Получения списка мероприятий
     *
     * @throws FailedToGetShowEventsException
     */
    public function get(int $showId): EventsResponseDTO;
}
