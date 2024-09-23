<?php

declare(strict_types=1);

namespace App\Helpers\Mapping;

use App\Helpers\Mapping\Exception\CouldNotMapValue;
use App\Helpers\Mapping\Exception\InvalidKey;
use App\Helpers\Mapping\Exception\MappingException;
use App\Helpers\Mapping\Exception\UnexpectedValue;
use Carbon\CarbonImmutable;

/**
 * Служба обработки значений массива.
 */
final class Mapping
{
    /**
     * Точность числа с плавающей точкой по умолчанию.
     */
    private const PRECISION = 2;

    /**
     * Возвращает массив.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  int|string  $key  Ключ.
     * @return array<mixed>
     *
     * @throws MappingException
     */
    public static function asArray(array $data, int|string $key): array
    {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapArray($key, $data[$key]);
    }

    /**
     * Возвращает булево значение.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  int|string  $key  Ключ.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    public static function asBool(array $data, int|string $key, bool $strict = true): bool
    {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapBool($key, $data[$key], $strict);
    }

    /**
     * Возвращает объект DateTimeImmutable.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  int|string  $key  Ключ.
     *
     * @throws MappingException
     */
    public static function asDateTimeImmutable(
        array $data,
        int|string $key,
    ): CarbonImmutable {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapDateTimeImmutable($key, $data[$key]);
    }

    /**
     * Возвращает целочисленное значение.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  int|string  $key  Ключ.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    public static function asInt(array $data, int|string $key, bool $strict = true): int
    {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapInt($key, $data[$key], $strict);
    }

    /**
     * Возвращает значение с плавающей точкой.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  string|int  $key  Ключ.
     * @param  bool  $strict  Признак строгой проверки.
     * @param  int  $precision  Точность.
     *
     * @throws MappingException
     */
    public static function asFloat(
        array $data,
        int|string $key,
        bool $strict = true,
        int $precision = self::PRECISION,
    ): float {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapFloat($key, $data[$key], $strict, $precision);
    }

    /**
     * Возвращает строковое значение.
     *
     * @param  array<mixed>  $data  Данные.
     * @param  string|int  $key  Ключ.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    public static function asString(
        array $data,
        int|string $key,
        bool $strict = true,
    ): string {
        if (! array_key_exists($key, $data)) {
            throw InvalidKey::withKey($key);
        }

        return self::mapString($key, $data[$key], $strict);
    }

    /**
     * Возвращает массив.
     *
     * @param  string|int  $key  Ключ.
     * @param  mixed  $value  Значение.
     * @return array<mixed>
     *
     * @throws MappingException
     */
    public static function mapArray($key, $value): array
    {
        if (! \is_array($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'array', $value);
        }

        return $value;
    }

    /**
     * Возвращает преобразованное булевое значение.
     *
     * @param  string|int  $key  Ключ.
     * @param  mixed  $value  Значение.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    private static function mapBool($key, $value, bool $strict): bool
    {
        if ($strict && ! \is_bool($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'bool', $value);
        }

        return (bool) $value;
    }

    /**
     * Возвращает преобразованный объект DateTimeImmutable.
     *
     * @param  string|int  $key  Ключ.
     * @param  mixed  $value  Значение.
     *
     * @throws MappingException
     */
    public static function mapDateTimeImmutable($key, $value): CarbonImmutable
    {
        if ($value instanceof CarbonImmutable) {
            return $value;
        }

        if ($value instanceof \DateTimeImmutable) {
            return CarbonImmutable::parse($value);
        }

        if (! \is_string($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'string', $value);
        }

        try {
            return CarbonImmutable::parse($value);
        } catch (\Throwable $e) {
            throw CouldNotMapValue::withKeyToType($key, 'DateTimeImmutable');
        }
    }

    /**
     * Возвращает преобразованное целочисленное значение.
     *
     * @param  string|int  $key  Ключ.
     * @param  mixed  $value  Значение.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    private static function mapInt($key, $value, bool $strict): int
    {
        if (! \is_numeric($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'numeric', $value);
        }
        if ($strict && ! \is_int($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'int', $value);
        }

        return (int) $value;
    }

    /**
     * Возвращает преобразованное значение с плавающей точкой.
     *
     * @param  string|int  $key  Ключ.
     * @param  mixed  $value  Значение.
     * @param  bool  $strict  Признак строгой проверки.
     * @param  int  $precision  Точность.
     *
     * @throws MappingException
     */
    private static function mapFloat(
        $key,
        $value,
        bool $strict,
        int $precision,
    ): float {
        if (! \is_numeric($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'numeric', $value);
        }
        if ($strict && ! \is_float($value) && ! \is_int($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'float', $value);
        }

        return \round((float) $value, $precision);
    }

    /**
     * Возвращает преобразованное строковое значение.
     *
     * @param  int|string  $key  Ключ.
     * @param  mixed  $value  Значение.
     * @param  bool  $strict  Признак строгой проверки.
     *
     * @throws MappingException
     */
    private static function mapString(int|string $key, mixed $value, bool $strict): string
    {
        if (! \is_scalar($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'scalar', $value);
        }
        if ($strict && ! \is_string($value)) {
            throw UnexpectedValue::withKeyOfType($key, 'string', $value);
        }

        return (string) $value;
    }
}
