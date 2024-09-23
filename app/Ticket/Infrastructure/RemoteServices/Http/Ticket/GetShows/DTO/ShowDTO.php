<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\DTO;

/**
 * DTO объект мероприятия
 */
final readonly class ShowDTO
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}
}
