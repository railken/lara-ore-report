<?php

namespace Railken\LaraOre\Report;

use Illuminate\Support\Collection;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelSerializer;

class ReportSerializer extends ModelSerializer
{
    /**
     * Serialize entity.
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     * @param \Illuminate\Support\Collection                    $select
     *
     * @return \Railken\Bag
     */
    public function serialize(EntityContract $entity, Collection $select = null)
    {
        $bag = parent::serialize($entity, $select);

        // ...

        return $bag;
    }
}
