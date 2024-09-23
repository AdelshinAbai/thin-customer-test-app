<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Ticket;

use App\Http\Controllers\Api\Ticket\EventListController;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\AbstractFeatureTestCase;

/**
 * @see EventListController
 */
final class EventListControllerTest extends AbstractFeatureTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(['/test-task-api/shows' => Http::response([
            'response' => [
                [
                    'id' => 111,
                    'name' => 'Show #111',
                ],
                [
                    'id' => 112,
                    'name' => 'Show #112',
                ],
            ],
        ]),
        ]);
    }

    /**
     * Успешный тест запроса Список мероприятий
     *
     * @see EventListController::__invoke()
     */
    public function testCase1(): void
    {
        //give
        $url = '/api/shows';

        //when
        $response = $this->get($url);

        // then
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['response' => [
                '*' => [
                    'id',
                    'name',
                ],
            ],
            ])->assertJson(
                static fn (AssertableJson $json): AssertableJson => $json->has('response', 2)
                    ->has('response.0', static fn (AssertableJson $json) => $json->where('id', 111)
                        ->where('name', 'Show #111')
                    )
                    ->has('response.1', static fn (AssertableJson $json) => $json->where('id', 112)
                        ->where('name', 'Show #112')
                    )
            );
    }
}
