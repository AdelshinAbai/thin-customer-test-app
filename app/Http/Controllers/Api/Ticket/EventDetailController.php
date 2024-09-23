<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Ticket\Application\Services\GetShowEvents\GetShowEventsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/shows/{showId}/events',
    summary: 'Список событий мероприятия',
    tags: ['api:ticket:shows'],
    parameters: [new OA\Parameter(name: 'showId', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
    responses: [
        new OA\Response(
            response: 200,
            description: 'The data',
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(ref: '#/components/schemas/EventsResponseDTO'),
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ]
)]
class EventDetailController extends Controller
{
    public function __construct(
        private readonly GetShowEventsServiceInterface $getShowEventsService,
    ) {}

    /**
     * Метод для получения списка событий мероприятия
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->getShowEventsService->get(
            showId: (int) $request->route(param: 'showId')
        ));
    }
}
