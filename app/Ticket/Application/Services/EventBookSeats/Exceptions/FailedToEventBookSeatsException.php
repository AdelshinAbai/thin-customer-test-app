<?php

declare(strict_types=1);

namespace App\Ticket\Application\Services\EventBookSeats\Exceptions;

use App\Exceptions\Application\AbstractApplicationException;

/**
 * Исключение: не удалось забронировать места события
 */
class FailedToEventBookSeatsException extends AbstractApplicationException {}
