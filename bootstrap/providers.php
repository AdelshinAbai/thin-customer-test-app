<?php

return [
    App\Providers\AppServiceProvider::class,

    /**
     * Провайдер для http адаптеров
     */
    App\Providers\HttAdapterProvider::class,

    /**
     * Провайдер на реализации сервисного слоя
     */
    App\Providers\TicketServiceProvider::class,
];
