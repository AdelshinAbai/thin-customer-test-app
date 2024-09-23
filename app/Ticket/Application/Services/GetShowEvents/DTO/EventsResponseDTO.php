<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShowEvents\DTO;

use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;

/**
 * DTO response объекта списка событий мероприятия
 */
#[OA\Schema(title: 'events', description: 'Списка событий мероприятия')]
final readonly class EventsResponseDTO
{
    /**
     * @param  Collection<int,EventResponseDTO>  $response
     */
    public function __construct(
        #[OA\Property(
            property: 'response',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/EventResponseDTO')
        )]
        public Collection $response,
    ) {}
}
