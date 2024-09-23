<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetEventPlaces\Exceptions;

use App\Exceptions\Application\AbstractApplicationException;

/**
 * Исключение: не удалось получить список событий мероприятия
 */
class FailedToGetEventPlacesException extends AbstractApplicationException {}
