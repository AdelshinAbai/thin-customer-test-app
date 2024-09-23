<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Абстрактный класс для Feature-тестирования.
 */
abstract class AbstractFeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        parent::tearDown();

        echo \PHP_EOL,
        'Memory usage: ',
        (int) (memory_get_usage(true) / (1024 * 1024)),
        'MB for '.static::class;
    }
}
