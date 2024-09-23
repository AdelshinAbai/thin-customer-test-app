<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetEventPlaces\DTO;

use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;

/**
 * DTO response объекта списка мест события
 */
#[OA\Schema(title: 'places', description: 'Списка мест события')]
final readonly class PlacesResponseDTO
{
    /**
     * @param  Collection<int,PlaceResponseDTO>  $response
     */
    public function __construct(
        #[OA\Property(
            property: 'response',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/PlaceResponseDTO')
        )]
        public Collection $response,
    ) {}
}
