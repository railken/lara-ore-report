<?php

namespace Railken\LaraOre\Contracts;

use Closure;
use Illuminate\Support\Collection;

interface ReportRepositoryContract
{
    public function newQuery();

    public function getTableName();

    public function extract(Collection $resources, Closure $callback);
}
