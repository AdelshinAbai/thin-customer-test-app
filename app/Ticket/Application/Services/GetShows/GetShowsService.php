<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShows;

use App\Ticket\Application\Services\GetShows\DTO\ShowResponseDTO;
use App\Ticket\Application\Services\GetShows\DTO\ShowsResponseDTO;
use App\Ticket\Application\Services\GetShows\Exceptions\FailedToGetShowsException;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\DTO\ShowDTO;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\GetShowsAdapterInterface;
use Illuminate\Support\Collection;

/**
 * Реализация службы для получения списка мероприятий
 */
final readonly class GetShowsService implements GetShowsServiceInterface
{
    public function __construct(
        private GetShowsAdapterInterface $getShowsAdapter
    ) {}

    /**
     * {@inheritdoc}
     */
    public function get(): ShowsResponseDTO
    {
        try {
            return $this->mapperShowsResponseDTO(collection: $this->getShowsAdapter->get());
        } catch (\Throwable $exception) {
            throw new FailedToGetShowsException(
                message: 'Ошибка при получения списка мероприятий',
                code: 0,
                previous: $exception
            );
        }
    }

    /**
     * @param  Collection<int,ShowDTO>  $collection
     */
    private function mapperShowsResponseDTO(Collection $collection): ShowsResponseDTO
    {
        $response = collect();
        foreach ($collection as $show) {
            $response->push(new ShowResponseDTO(
                id: $show->id,
                name: $show->name,
            ));
        }

        return new ShowsResponseDTO(
            response: $response
        );
    }
}
