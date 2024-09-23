<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShowEvents;

use App\Ticket\Application\Services\GetShowEvents\DTO\EventResponseDTO;
use App\Ticket\Application\Services\GetShowEvents\DTO\EventsResponseDTO;
use App\Ticket\Application\Services\GetShowEvents\Exceptions\FailedToGetShowEventsException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\DTO\EventDTO;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\GetShowEventsAdapterInterface;
use Illuminate\Support\Collection;

/**
 * Реализация службы для получения списка событий мероприятия
 */
final readonly class GetShowEventsService implements GetShowEventsServiceInterface
{
    public function __construct(
        private GetShowEventsAdapterInterface $getShowEventsAdapter
    ) {}

    /**
     * {@inheritdoc}
     */
    public function get(int $showId): EventsResponseDTO
    {
        try {
            return $this->mapperEventsResponseDTO(
                collection: $this->getShowEventsAdapter->get(showId: $showId)
            );
        } catch (\Throwable $exception) {
            throw new FailedToGetShowEventsException(
                message: 'Ошибка при получения списка событий мероприятия',
                code: 0,
                previous: $exception
            );
        }
    }

    /**
     * @param  Collection<int,EventDTO>  $collection
     */
    private function mapperEventsResponseDTO(Collection $collection): EventsResponseDTO
    {
        $response = collect();
        foreach ($collection as $event) {
            $response->push(new EventResponseDTO(
                id: $event->id,
                showId: $event->showId,
                date: $event->date->toDateTimeString()
            ));
        }

        return new EventsResponseDTO(
            response: $response
        );
    }
}
