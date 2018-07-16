<?php

namespace Railken\LaraOre\Report;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Contracts\EntityContract;

/**
 * @property string $name
 * @property string $repository
 * @property string $input
 * @property string $filter
 * @property string $body
 * @property string $filename
 */
class Report extends Model implements EntityContract
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'repository',
        'filter',
        'input',
        'filename',
        'body',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'input'     => 'object',
        'body'      => 'object',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('ore.report.table');
        $this->fillable = array_merge($this->fillable, array_keys(Config::get('ore.report.attributes')));
    }
}
