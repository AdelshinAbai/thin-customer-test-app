<?php

declare(strict_types=1);

namespace App\Providers;

use App\Ticket\Application\Services\EventBookSeats\EventBookSeatsService;
use App\Ticket\Application\Services\EventBookSeats\EventBookSeatsServiceInterface;
use App\Ticket\Application\Services\GetEventPlaces\GetEventPlacesService;
use App\Ticket\Application\Services\GetEventPlaces\GetEventPlacesServiceInterface;
use App\Ticket\Application\Services\GetShowEvents\GetShowEventsService;
use App\Ticket\Application\Services\GetShowEvents\GetShowEventsServiceInterface;
use App\Ticket\Application\Services\GetShows\GetShowsService;
use App\Ticket\Application\Services\GetShows\GetShowsServiceInterface;
use Illuminate\Support\ServiceProvider;

final class TicketServiceProvider extends ServiceProvider
{
    public array $bindings = [
        /** Сервис для получения списка мероприятий */
        GetShowsServiceInterface::class => GetShowsService::class,
        /** Сервис для получения списка событий мероприятия */
        GetShowEventsServiceInterface::class => GetShowEventsService::class,
        /** Сервис для получения списка мест события */
        GetEventPlacesServiceInterface::class => GetEventPlacesService::class,
        /** Сервис для бронирования мест на событие */
        EventBookSeatsServiceInterface::class => EventBookSeatsService::class,
    ];
}
