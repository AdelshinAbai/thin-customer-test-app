<?php

declare(strict_types=1);

namespace App\Helpers\Mapping\Exception;

/**
 * Ключ отсутствует в массиве.
 */
final class InvalidKey extends MappingException
{
    /**
     * Создаёт объект исключения для переданного ключа.
     *
     * @param  string|int  $key  Ключ массива.
     */
    public static function withKey($key): self
    {
        return new self(\sprintf('В массиве отсутствует ключ %s', $key));
    }
}
