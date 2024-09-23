<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\EventBookSeats\DTO;

use OpenApi\Attributes as OA;

/**
 * DTO response объект бронирование
 */
#[OA\Schema(title: 'reserve', description: 'объект бронирование')]
final readonly class ReserveResponseDTO
{
    public function __construct(
        #[OA\Property(property: 'reservation_id', description: 'ID резерва', type: 'string')]
        public string $reservation_id,
        #[OA\Property(property: 'success', description: 'Результат бронирования', type: 'boolean')]
        public bool $success,
    ) {}
}
