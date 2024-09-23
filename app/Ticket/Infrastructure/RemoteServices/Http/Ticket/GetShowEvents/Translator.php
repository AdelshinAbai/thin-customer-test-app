<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents;

use App\Helpers\Mapping\Mapping;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShowEvents\DTO\EventDTO;
use Illuminate\Support\Collection;

/**
 * Класс-трансформер ответа от адаптера
 */
final readonly class Translator
{
    /**
     * @return Collection<int,EventDTO>
     */
    public function transform(array $data): Collection
    {
        $result = new Collection;

        $shows = Mapping::asArray($data, 'response');

        foreach ($shows as $event) {
            $result->push(new EventDTO(
                id: Mapping::asInt($event, 'id'),
                showId: Mapping::asInt($event, 'showId'),
                date: Mapping::asDateTimeImmutable($event, 'date'),
            ));
        }

        return $result;
    }
}
