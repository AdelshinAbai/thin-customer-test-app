<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShowEvents\Exceptions;

use App\Exceptions\Application\AbstractApplicationException;

/**
 * Исключение: не удалось получить список событий мероприятия
 */
class FailedToGetShowEventsException extends AbstractApplicationException {}
