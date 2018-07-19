<?php

namespace Railken\LaraOre\Tests\Report\Repositories;

use Railken\LaraOre\Contracts\RepositoryContract;
use Railken\LaraOre\Report\ReportManager;
use Illuminate\Support\Collection;
use Closure;

class ReportRepository implements RepositoryContract
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
    
    /**
     * @param Collection $resources
     * @param \Closure $callback
     */
    public function extract(Collection $resources, Closure $callback)
    {
        foreach ($resources as $resource) {
            $callback($resource, ['order' => $resource]);
        }
    }
}
