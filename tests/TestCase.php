<?php

use \Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * Class TestCase
 */
abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    use DatabaseMigrations;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }
}
