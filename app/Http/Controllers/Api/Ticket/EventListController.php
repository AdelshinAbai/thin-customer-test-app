<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Ticket\Application\Services\GetShows\GetShowsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/shows',
    summary: 'Список мероприятий',
    tags: ['api:ticket:shows'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'The data',
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(ref: '#/components/schemas/ShowsResponseDTO'),
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ]
)]
final class EventListController extends Controller
{
    public function __construct(
        private readonly GetShowsServiceInterface $getShowsService,
    ) {}

    /**
     * Метод для получения списка мероприятий
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->getShowsService->get());
    }
}
