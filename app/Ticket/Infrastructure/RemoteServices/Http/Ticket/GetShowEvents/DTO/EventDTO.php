<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\DTO;

use Carbon\CarbonInterface;

/**
 * DTO объект событие
 */
final readonly class EventDTO
{
    public function __construct(
        public int $id,
        public int $showId,
        public CarbonInterface $date,
    ) {}
}
