<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Ticket;

use App\Http\Controllers\Api\Ticket\EventDetailWithPlacesController;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\AbstractFeatureTestCase;

/**
 * @see EventDetailWithPlacesController
 */
final class EventDetailWithPlacesControllerTest extends AbstractFeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '/test-task-api/events/20/places' => Http::response([
                'response' => [
                    [
                        'id' => 21,
                        'x' => 0,
                        'y' => 0,
                        'width' => 20,
                        'height' => 30,
                        'is_available' => true,
                    ],
                    [
                        'id' => 22,
                        'x' => 0,
                        'y' => 0,
                        'width' => 30,
                        'height' => 40,
                        'is_available' => false,
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Успешный тест кейс, список мест события
     *
     * @see EventDetailWithPlacesController::__invoke()
     */
    public function testCase1(): void
    {
        //give
        $url = '/api/events/20/places';

        //when
        $response = $this->get($url);

        //then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'response' => [
                    '*' => ['id', 'x', 'y', 'width', 'height', 'is_available'],
                ],
            ])->assertJson(static fn (AssertableJson $json): AssertableJson => $json->has('response', 2)
            ->has('response.0', static fn (AssertableJson $json) => $json->where('id', 21)
                ->where('x', 0)
                ->where('y', 0)
                ->where('width', 20)
                ->where('height', 30)
                ->where('is_available', true)
            )
            ->has('response.1', static fn (AssertableJson $json) => $json->where('id', 22)
                ->where('x', 0)
                ->where('y', 0)
                ->where('width', 30)
                ->where('height', 40)
                ->where('is_available', false)
            )
            );
    }
}
