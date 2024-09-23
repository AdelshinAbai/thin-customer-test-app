<?php

declare(strict_types=1);

namespace App\Ticket\Infrastructure\RemoteServices\Http\Client;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Служба поставщик HTTP клиента для API билетного шлюза.
 */
final readonly class TicketHttpClientProvider
{
    /**
     * Метод получения клиента.
     */
    public function getClient(): PendingRequest
    {
        return Http::baseUrl($this->getUrl());
    }

    private function getUrl(): string
    {
        return config('gateway.services.ticket.base_url');
    }
}
