<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\DTO;

/**
 * DTO объект бронирование
 */
final readonly class ReserveDTO
{
    public function __construct(
        public string $reservation_id,
        public bool $success,
    ) {}
}
