<?php

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces;

use App\Exceptions\Infrastructure\NetworkException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\Exceptions\AdapterException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\DTO\PlaceDTO;
use Illuminate\Support\Collection;

/**
 * Интерфейс адаптера для получения списка мест события
 */
interface GetEventPlacesAdapterInterface
{
    /**
     * Получить список мест события
     *
     * @return Collection<int,PlaceDTO>
     *
     * @throws NetworkException
     * @throws AdapterException
     */
    public function get(int $eventId): Collection;
}
