<?php

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\DTO\ShowDTO;
use Illuminate\Support\Collection;

/**
 * Интерфейс адаптера для получения списка мероприятий
 */
interface GetShowsAdapterInterface
{
    /**
     * Получить список мероприятий
     *
     * @return Collection<int,ShowDTO>
     *
     * @throws NetworkException
     * @throws AdapterException
     */
    public function get(): Collection;
}
