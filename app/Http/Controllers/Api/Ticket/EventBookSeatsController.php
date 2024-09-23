<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Ticket\Application\Services\EventBookSeats\EventBookSeatsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/events/{eventId}/reserve',
    summary: 'Забронировать места события',
    requestBody: new OA\RequestBody(
        description: 'параметры',
        required: true,
        content: new OA\MediaType(
            mediaType: 'application/x-www-form-urlencoded',
            schema: new OA\Schema(
                required: ['name', 'places[]'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'places[]', type: 'array', items: new OA\Items(type: 'integer')),
                ]
            )
        )
    ),
    tags: ['api:ticket:events'],
    parameters: [
        new OA\Parameter(name: 'eventId', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'The data',
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(ref: '#/components/schemas/EventBookSeatsResponseDTO'),
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ]
)]
class EventBookSeatsController extends Controller
{
    public function __construct(
        private readonly EventBookSeatsServiceInterface $eventBookSeatsService,
    ) {}

    /**
     * Метод Забронировать места события
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'places' => 'required|array',
            'places.*' => 'required|integer',
        ]);

        return response()->json($this->eventBookSeatsService->reserve(
            eventId: (int) $request->route(param: 'eventId'),
            name: $validated['name'],
            placeIds: $validated['places'],
        ));
    }
}
