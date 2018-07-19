<?php

namespace Railken\LaraOre\Report;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Railken\LaraOre\Jobs\GenerateReport;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Result;
use Railken\Laravel\Manager\Tokens;

class ReportManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Report::class;

    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Name\NameAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\DeletedAt\DeletedAtAttribute::class,
        Attributes\Input\InputAttribute::class,
        Attributes\Filename\FilenameAttribute::class,
        Attributes\Body\BodyAttribute::class,
        Attributes\RepositoryId\RepositoryIdAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\ReportNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->entity = Config::get('ore.report.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.report.attributes')));

        $classRepository = Config::get('ore.report.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.report.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.report.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.report.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }

    /**
     * Request a report.
     *
     * @param Report $report
     * @param array  $data
     *
     * @return \Railken\Laravel\Manager\Contracts\ResultContract
     */
    public function generate(Report $report, array $data = [])
    {
        $result = new Result();

        if (count((array) $report->input) !== 0) {
            $validator = Validator::make($data, (array) $report->input);

            $errors = collect();

            foreach ($validator->errors()->getMessages() as $key => $error) {
                $errors[] = new Exceptions\ReportInputException($key, $error[0], $data[$key]);
            }

            $result->addErrors($errors);
        }

        if (!$result->ok()) {
            return $result;
        }

        dispatch(new GenerateReport($report, $data, $this->getAgent()));

        return $result;
    }
}
