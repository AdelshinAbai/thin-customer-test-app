<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Ticket;

use App\Http\Controllers\Api\Ticket\EventDetailController;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\AbstractFeatureTestCase;

/**
 * @see EventDetailController
 */
final class EventDetailControllerTest extends AbstractFeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '/test-task-api/shows/10/events' => Http::response([
                'response' => [
                    [
                        'id' => 11,
                        'showId' => 10,
                        'date' => '2024-09-01 00:00:01',
                    ],
                    [
                        'id' => 12,
                        'showId' => 10,
                        'date' => '2024-09-01 00:00:02',
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Успешный тест кейс, список событий мероприятия
     *
     * @see EventDetailController::__invoke()
     */
    public function testCase1(): void
    {
        //give
        $url = '/api/shows/10/events';

        //when
        $response = $this->get($url);

        //then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'response' => [
                    '*' => ['id', 'showId', 'date'],
                ],
            ])->assertJson(static fn (AssertableJson $json): AssertableJson => $json->has('response', 2)
            ->has('response.0', static fn (AssertableJson $json) => $json->where('id', 11)
                ->where('showId', 10)
                ->where('date', '2024-09-01 00:00:01')
            )
            ->has('response.1', static fn (AssertableJson $json) => $json->where('id', 12)
                ->where('showId', 10)
                ->where('date', '2024-09-01 00:00:02')
            )
            );
    }
}
