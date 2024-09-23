<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShows\DTO;

use OpenApi\Attributes as OA;

/**
 * DTO response объекта мероприятия
 */
#[OA\Schema(title: 'show', description: 'Мероприятие')]
final readonly class ShowResponseDTO
{
    public function __construct(
        #[OA\Property(property: 'id', description: 'ID мероприятия', type: 'integer')]
        public int $id,
        #[OA\Property(property: 'name', description: 'Название мероприятия', type: 'string')]
        public string $name,
    ) {}
}
