<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats;

use App\Helpers\Mapping\Mapping;
use App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\DTO\ReserveDTO;

/**
 * Класс-трансформер ответа от адаптера
 */
final readonly class Translator
{
    public function transform(array $data): ReserveDTO
    {
        $reserve = Mapping::asArray($data, 'response');

        return new ReserveDTO(
            reservation_id: Mapping::asString($reserve, 'reservation_id'),
            success: Mapping::asBool($reserve, 'success'),
        );
    }
}
