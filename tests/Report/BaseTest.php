<?php

namespace Railken\LaraOre\Tests\Report;

use Illuminate\Support\Facades\File;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\ReportServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/../..', '.env');
        $dotenv->load();

        parent::setUp();

        File::cleanDirectory(database_path('migrations/'));

        $this->artisan('migrate:fresh');
        $this->artisan('vendor:publish', ['--provider' => 'Railken\LaraOre\ReportServiceProvider', '--force' => true]);
        $this->artisan('vendor:publish', ['--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider', '--force'    => true]);

        $this->artisan('migrate');
    }
}
