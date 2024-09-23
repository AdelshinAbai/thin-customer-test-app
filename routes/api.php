<?php

use App\Http\Controllers\Api\Ticket\EventBookSeatsController;
use App\Http\Controllers\Api\Ticket\EventDetailController;
use App\Http\Controllers\Api\Ticket\EventDetailWithPlacesController;
use App\Http\Controllers\Api\Ticket\EventListController;
use Illuminate\Support\Facades\Route;

Route::get('/shows', EventListController::class);
Route::get('/shows/{showId}/events', EventDetailController::class);
Route::get('/events/{eventId}/places', EventDetailWithPlacesController::class);
Route::post('/events/{eventId}/reserve', EventBookSeatsController::class);
