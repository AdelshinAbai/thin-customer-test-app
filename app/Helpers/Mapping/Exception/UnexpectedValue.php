<?php

declare(strict_types=1);

namespace App\Helpers\Mapping\Exception;

/**
 * Полученное значение не соответствует ожиданиям.
 */
final class UnexpectedValue extends MappingException
{
    /**
     * Создаёт объект исключения с переданными данными.
     *
     * @param  int|string  $key  Ключ массива.
     * @param  string  $expectedType  Ожидаемый тип.
     * @param  mixed  $value  Значение ключа.
     */
    public static function withKeyOfType(
        int|string $key,
        string $expectedType,
        mixed $value,
    ): self {
        $type = gettype($value);

        return new self(
            \sprintf(
                'Ожидалось значение типа %s для ключа %s, поступило: %s',
                $expectedType,
                $key,
                $type,
            ),
        );
    }
}
