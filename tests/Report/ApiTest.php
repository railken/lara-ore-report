<?php

namespace Railken\LaraOre\Tests\Report;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Report\ReportFaker;
use Railken\LaraOre\Report\ReportManager;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.report.http.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->commonTest($this->getBaseUrl(), ReportFaker::make()->parameters());
    }

    public function testGenerate()
    {
        $manager = new ReportManager();

        $result = $manager->create(ReportFaker::make()->parameters()->set('repository', \Railken\LaraOre\Tests\Report\Repositories\ReportRepository::class));
        $this->assertEquals(1, $result->ok());
        $resource = $result->getResource();

        $response = $this->post($this->getBaseUrl() . "/" . $resource->id . "/generate", ['data' => ['name' => $resource->name]]);
        $response->assertStatus(200);
    }
}
