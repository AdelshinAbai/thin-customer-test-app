<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Ticket\EventBookSeats\Exceptions;

use App\Exceptions\Infrastructure\AbstractInfrastructureException;

/**
 * Исключение при работе адаптера.
 */
final class FailedToEventBookSeatsAdapterException extends AbstractInfrastructureException {}
