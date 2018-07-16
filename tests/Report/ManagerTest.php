<?php

namespace Railken\LaraOre\Tests\Report;

use Railken\LaraOre\Report\ReportFaker;
use Railken\LaraOre\Report\ReportManager;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new ReportManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), ReportFaker::make()->parameters());
    }

    public function testGenerate()
    {
        $manager = $this->getManager();

        $result = $manager->create(ReportFaker::make()->parameters()->set('repository', \Railken\LaraOre\Tests\Report\Repositories\ReportRepository::class));
        $this->assertEquals(1, $result->ok());

        $resource = $result->getResource();
        $result = $manager->generate($resource, ['name' => $resource->name]);
        $this->assertEquals(true, $result->ok());
    }
}
