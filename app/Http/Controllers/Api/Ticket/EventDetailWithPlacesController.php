<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Ticket\Application\Services\GetEventPlaces\GetEventPlacesServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/events/{eventId}/places',
    summary: 'Список мест события',
    tags: ['api:ticket:events'],
    parameters: [new OA\Parameter(name: 'eventId', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
    responses: [
        new OA\Response(
            response: 200,
            description: 'The data',
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(ref: '#/components/schemas/PlacesResponseDTO'),
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ]
)]
class EventDetailWithPlacesController extends Controller
{
    public function __construct(
        private readonly GetEventPlacesServiceInterface $getEventPlacesService,
    ) {}

    /**
     * Метод для получения списка мест события
     */
    public function __invoke(Request $request): JsonResponse
    {

        return response()->json($this->getEventPlacesService->get(
            eventId: (int) $request->route(param: 'eventId')
        ));
    }
}
