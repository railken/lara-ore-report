<?php

namespace Railken\LaraOre\Report;

use Faker\Factory;
use Railken\Bag;
use Railken\Laravel\Manager\BaseFaker;

class ReportFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = ReportManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('filter', "name = '{{ name }}'");

        return $bag;
    }
}
