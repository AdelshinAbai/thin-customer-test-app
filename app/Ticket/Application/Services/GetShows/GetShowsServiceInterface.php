<?php

namespace App\Ticket\Application\Services\GetShows;

use App\Ticket\Application\Services\GetShows\DTO\ShowsResponseDTO;
use App\Ticket\Application\Services\GetShows\Exceptions\FailedToGetShowsException;

/**
 * Интерфейс службы для получения списка мероприятий
 */
interface GetShowsServiceInterface
{
    /**
     * Получения списка мероприятий
     *
     * @throws FailedToGetShowsException
     */
    public function get(): ShowsResponseDTO;
}
