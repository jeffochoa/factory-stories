<?php

namespace Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/factories');
    }
}
