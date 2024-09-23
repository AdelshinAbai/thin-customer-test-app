<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetEventPlaces\DTO;

use OpenApi\Attributes as OA;

/**
 * DTO response объекта мест
 */
#[OA\Schema(title: 'place', description: 'Мест')]
final readonly class PlaceResponseDTO
{
    public function __construct(
        #[OA\Property(property: 'id', description: 'ID места', type: 'integer')]
        public int $id,
        #[OA\Property(property: 'x', description: 'Координата X', type: 'double')]
        public float $x,
        #[OA\Property(property: 'y', description: 'Координата Y', type: 'number')]
        public float $y,
        #[OA\Property(property: 'width', description: 'Ширина', type: 'number')]
        public float $width,
        #[OA\Property(property: 'height', description: 'Высота', type: 'number')]
        public float $height,
        #[OA\Property(property: 'is_available', description: 'Место доступно', type: 'boolean')]
        public bool $is_available,
    ) {}
}
