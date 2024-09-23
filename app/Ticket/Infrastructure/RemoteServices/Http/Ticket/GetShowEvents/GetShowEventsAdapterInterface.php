<?php

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\DTO\EventDTO;
use Illuminate\Support\Collection;

/**
 * Интерфейс адаптера для получения списка событий мероприятия
 */
interface GetShowEventsAdapterInterface
{
    /**
     * Получить список событий мероприятия
     *
     * @return Collection<int,EventDTO>
     *
     * @throws NetworkException
     * @throws AdapterException
     */
    public function get(int $showId): Collection;
}
