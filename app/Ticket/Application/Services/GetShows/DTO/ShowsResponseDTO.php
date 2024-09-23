<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShows\DTO;

use Illuminate\Support\Collection;
use OpenApi\Attributes as OA;

/**
 * DTO response объекта списка мероприятий
 */
#[OA\Schema(title: 'shows', description: 'Список мероприятий')]
final readonly class ShowsResponseDTO
{
    /**
     * @param  Collection<int,ShowResponseDTO>  $response
     */
    public function __construct(
        #[OA\Property(
            property: 'response',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ShowResponseDTO')
        )]
        public Collection $response,
    ) {}
}
