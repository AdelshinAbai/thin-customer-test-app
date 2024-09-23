<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Ticket;

use App\Http\Controllers\Api\Ticket\EventBookSeatsController;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\AbstractFeatureTestCase;

/**
 * @see EventBookSeatsController
 */
final class EventBookSeatsControllerTest extends AbstractFeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '/test-task-api/events/1/reserve' => Http::response([
                'response' => [
                    'success' => true,
                    'reservation_id' => 'test5d519fe58e3cf',
                ],
            ]),
        ]);
    }

    /**
     * Успешный тест кейс, забронировать места события
     *
     * @see EventBookSeatsController::__invoke()
     */
    public function testCase1(): void
    {
        //give
        $url = '/api/events/1/reserve';

        //when
        $response = $this->post(
            uri: $url,
            data: [
                'name' => 'test',
                'places' => [1],
            ]
        );

        //then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'response' => [
                    'success', 'reservation_id',
                ],
            ])->assertJson(static fn (AssertableJson $json): AssertableJson => $json
            ->has('response', static fn (AssertableJson $json) => $json->where('success', true)
                ->where('reservation_id', 'test5d519fe58e3cf')
            )
            );
    }
}
