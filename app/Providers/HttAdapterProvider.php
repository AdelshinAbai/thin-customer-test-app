<?php

declare(strict_types=1);

namespace App\Providers;

use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\EventBookSeatsAdapter;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\EventBookSeatsAdapterInterface;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\GetEventPlacesAdapter;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\GetEventPlacesAdapterInterface;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\GetShowEventsAdapter;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\GetShowEventsAdapterInterface;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\GetShowsAdapter;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\GetShowsAdapterInterface;
use Illuminate\Support\ServiceProvider;

final class HttAdapterProvider extends ServiceProvider
{
    public array $bindings = [
        /** Адаптер для получения списка мероприятий */
        GetShowsAdapterInterface::class => GetShowsAdapter::class,
        /** Адаптер для получения списка событий мероприятия */
        GetShowEventsAdapterInterface::class => GetShowEventsAdapter::class,
        /** Адаптер для получения списка мест события */
        GetEventPlacesAdapterInterface::class => GetEventPlacesAdapter::class,
        /** Адаптер для получения списка мест события */
        EventBookSeatsAdapterInterface::class => EventBookSeatsAdapter::class,
    ];
}
