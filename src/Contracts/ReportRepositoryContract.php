<?php

namespace Railken\LaraOre\Contracts;

interface ReportRepositoryContract
{
    public function newQuery();

    public function getTableName();
}
