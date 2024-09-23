<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\DTO;

/**
 * DTO объект место
 */
final readonly class PlaceDTO
{
    public function __construct(
        public int $id,
        public float $x,
        public float $y,
        public float $width,
        public float $height,
        public bool $is_available,
    ) {}
}
