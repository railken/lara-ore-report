<?php

namespace Railken\LaraOre\Tests\Report\Repositories;

use Railken\LaraOre\Contracts\ReportRepositoryContract;
use Railken\LaraOre\Report\ReportManager;

class ReportRepository implements ReportRepositoryContract
{
    protected $manager;
    
    public function __construct()
    {
        $this->manager = new ReportManager();
    }

    public function newQuery()
    {
        return $this->manager->getRepository()->newQuery();
    }

    public function getTableName()
    {
        return $this->manager->newEntity()->getTable();
    }
}
