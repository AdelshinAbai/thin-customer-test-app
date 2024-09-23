<?php

declare(strict_types=1);

namespace App\Helpers\Mapping\Exception;

/**
 * Ошибка преобразования значения.
 */
final class CouldNotMapValue extends MappingException
{
    /**
     * Создаёт объект исключения с переданными данными.
     *
     * @param  string|int  $key  Ключ массива.
     * @param  string  $returnedType  Возвращаемый тип.
     */
    public static function withKeyToType($key, string $returnedType): self
    {
        return new self(
            \sprintf(
                'Невалидное значение ключа %s для преобразования в тип %s',
                $key,
                $returnedType,
            ),
        );
    }
}
