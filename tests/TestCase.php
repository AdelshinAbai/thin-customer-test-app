<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Базовый класс тест-кейса.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
