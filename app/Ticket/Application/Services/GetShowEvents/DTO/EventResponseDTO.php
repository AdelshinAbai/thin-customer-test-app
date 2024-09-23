<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShowEvents\DTO;

use OpenApi\Attributes as OA;

/**
 * DTO response объекта событие
 */
#[OA\Schema(title: 'event', description: 'Событие')]
final readonly class EventResponseDTO
{
    public function __construct(
        #[OA\Property(property: 'id', description: 'ID события', type: 'integer')]
        public int $id,
        #[OA\Property(property: 'showId', description: 'ID мероприятия', type: 'integer')]
        public int $showId,
        #[OA\Property(property: 'date', description: 'Дата события', type: 'string')]
        public string $date,
    ) {}
}
