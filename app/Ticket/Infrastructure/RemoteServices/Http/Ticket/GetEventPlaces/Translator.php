<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces;

use App\Helpers\Mapping\Mapping;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetEventPlaces\DTO\PlaceDTO;
use Illuminate\Support\Collection;

/**
 * Класс-трансформер ответа от адаптера
 */
final readonly class Translator
{
    /**
     * @return Collection<int,PlaceDTO>
     */
    public function transform(array $data): Collection
    {
        $result = new Collection;

        $events = Mapping::asArray($data, 'response');

        foreach ($events as $place) {
            $result->push(new PlaceDTO(
                id: Mapping::asInt($place, 'id'),
                x: Mapping::asFloat($place, 'x'),
                y: Mapping::asFloat($place, 'y'),
                width: Mapping::asFloat($place, 'width'),
                height: Mapping::asFloat($place, 'height'),
                is_available: Mapping::asBool($place, 'is_available'),
            ));
        }

        return $result;
    }
}
