<?php

namespace Railken\LaraOre\Report;

use Faker\Factory;
use Railken\Bag;
use Railken\LaraOre\Repository\RepositoryFaker;
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
        $bag->set('repository', RepositoryFaker::make()->parameters()->toArray());
        $bag->set('input', [
            'name' => 'string',
        ]);
        $bag->set('filename', 'users-{{ "now"|date("Ymd") }}');
        $bag->set('body', [
            'name' => '{{ resource.name }}',
            'flag' => 2,
        ]);

        return $bag;
    }
}
