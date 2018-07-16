<?php

namespace Railken\LaraOre\Report;

use Illuminate\Support\Facades\Config;
use Railken\LaraEye\Filter;
use Railken\LaraOre\File\FileManager;
use Railken\LaraOre\Template\TemplateManager;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
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
        Attributes\Repository\RepositoryAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\DeletedAt\DeletedAtAttribute::class,
        Attributes\Filter\FilterAttribute::class,
        Attributes\Input\InputAttribute::class,
        Attributes\Filename\FilenameAttribute::class,
        Attributes\Body\BodyAttribute::class,
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
     * @param mixed  $user
     */
    public function generate(Report $report, array $data = [], $user = null)
    {
        $tm = new TemplateManager();

        $repository = new $report->repository();
        $query = $repository->newQuery();

        $filter = new Filter($repository->getTableName(), ['name']);
        $filter->build($query, $tm->renderRaw('text/plain', $report->filter, $data));

        $filename = tempnam('/tmp', '').'-'.time().'.csv';

        $file = fopen($filename, 'w');

        if (!$file) {
            throw new \Exception();
        }

        $head = array_keys((array) $report->body);
        $row = array_values((array) $report->body);

        fputcsv($file, $head);

        $query->chunk(100, function ($resources) use ($file, $report, $row, $tm) {
            foreach ($resources as $resource) {
                fputcsv($file, json_decode($tm->renderRaw('text/plain', json_encode($row), ['resource' => $resource]), true));
            }
        });

        $fm = new FileManager();
        $result = $fm->uploadFileFromFilesystem($filename);
        fclose($file);
    }
}
