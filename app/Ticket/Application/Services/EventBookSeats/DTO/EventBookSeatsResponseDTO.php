<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\EventBookSeats\DTO;

use OpenApi\Attributes as OA;

/**
 * DTO response объект бронирование
 */
#[OA\Schema(title: 'response', description: 'Бронирование')]
final readonly class EventBookSeatsResponseDTO
{
    public function __construct(
        #[OA\Property(
            property: 'response',
            ref: '#/components/schemas/ReserveResponseDTO'
        )]
        public ReserveResponseDTO $response,
    ) {}
}
