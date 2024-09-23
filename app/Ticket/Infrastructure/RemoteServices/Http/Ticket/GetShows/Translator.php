<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows;

use App\Helpers\Mapping\Mapping;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\GetShows\DTO\ShowDTO;
use Illuminate\Support\Collection;

/**
 * Класс-трансформер ответа от адаптера
 */
final readonly class Translator
{
    /**
     * @return Collection<int,ShowDTO>
     */
    public function transform(array $data): Collection
    {
        $result = new Collection;

        $shows = Mapping::asArray($data, 'response');

        foreach ($shows as $show) {
            $result->push(new ShowDTO(
                id: Mapping::asInt($show, 'id'),
                name: Mapping::asString($show, 'name'),
            ));
        }

        return $result;
    }
}
