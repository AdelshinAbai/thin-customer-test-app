<?php
/**
 * Настройки сервисов мероприятий
 */

return [

    /**
     * Сервис билетного шлюза
     */
    'ticket' => [

        /*
         * Корневой URL сервиса
         */
        'base_url' => env('EVENT_SERVICE_BASE_URL'),

        /* Данные для авторизации */
        'token' => env('EVENT_AUTH_TOKEN'),
        'debug' => env('EVENT_SERVICE_DEBUG', false),
    ],
];
