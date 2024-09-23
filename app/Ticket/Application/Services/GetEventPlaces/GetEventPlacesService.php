<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetEventPlaces;

use App\Ticket\Application\Services\GetEventPlaces\DTO\PlaceResponseDTO;
use App\Ticket\Application\Services\GetEventPlaces\DTO\PlacesResponseDTO;
use App\Ticket\Application\Services\GetShowEvents\Exceptions\FailedToGetShowEventsException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\DTO\PlaceDTO;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\GetEventPlacesAdapterInterface;
use Illuminate\Support\Collection;

/**
 * Реализация службы для получения списка мест события
 */
final readonly class GetEventPlacesService implements GetEventPlacesServiceInterface
{
    public function __construct(
        private GetEventPlacesAdapterInterface $getEventPlacesAdapter
    ) {}

    /**
     * {@inheritdoc}
     */
    public function get(int $eventId): PlacesResponseDTO
    {
        try {
            return $this->mapperPlacesResponseDTO(
                collection: $this->getEventPlacesAdapter->get(eventId: $eventId)
            );
        } catch (\Throwable $exception) {
            throw new FailedToGetShowEventsException(
                message: 'Ошибка при получения списка мест события',
                code: 0,
                previous: $exception
            );
        }
    }

    /**
     * @param  Collection<int,PlaceDTO>  $collection
     */
    private function mapperPlacesResponseDTO(Collection $collection): PlacesResponseDTO
    {
        $response = collect();
        foreach ($collection as $place) {
            $response->push(new PlaceResponseDTO(
                id: $place->id,
                x: $place->x,
                y: $place->y,
                width: $place->width,
                height: $place->height,
                is_available: $place->is_available,
            ));
        }

        return new PlacesResponseDTO(
            response: $response
        );
    }
}
