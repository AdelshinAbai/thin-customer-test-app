<?php

declare(strict_types=1);

namespace App\Helpers\Mapping\Exception;

/**
 * Абстрактное исключение службы обработки значений массива.
 */
abstract class MappingException extends \RuntimeException
{
    /**
     * Создаёт объект исключения.
     *
     * @param  string  $message  Сообщение об ошибке.
     */
    protected function __construct(string $message)
    {
        parent::__construct($message, 0, null);
    }
}
