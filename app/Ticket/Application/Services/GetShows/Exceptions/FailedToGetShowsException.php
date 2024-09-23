<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\GetShows\Exceptions;

use App\Exceptions\Application\AbstractApplicationException;

/**
 * Исключение: не удалось получить список мероприятий
 */
class FailedToGetShowsException extends AbstractApplicationException {}
