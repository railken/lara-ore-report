<?php

namespace Railken\LaraOre\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\LaraEye\Filter;
use Railken\LaraOre\Events\ReportGenerated;
use Railken\LaraOre\File\FileManager;
use Railken\LaraOre\Report\Report;
use Railken\LaraOre\Template\TemplateManager;
use Railken\Laravel\Manager\Contracts\AgentContract;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $report;
    protected $data;
    protected $agent;

    /**
     * Create a new job instance.
     *
     * @param Report                                           $report
     * @param array                                            $data
     * @param \Railken\Laravel\Manager\Contracts\AgentContract $agent
     */
    public function __construct(Report $report, array $data = [], AgentContract $agent = null)
    {
        $this->report = $report;
        $this->data = $data;
        $this->agent = $agent;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $report = $this->report;
        $data = $this->data;

        $tm = new TemplateManager();

        $repository = new $report->repository();
        $query = $repository->newQuery();

        if (!empty($report->filter)) {
            $filter = new Filter($repository->getTableName(), ['*']);
            $filter->build($query, $tm->renderRaw('text/plain', $report->filter, $data));
        }

        $filename = tempnam('/tmp', '').'-'.time().'.csv';

        $filename = sys_get_temp_dir().'/'.$report->id.'-'.$tm->renderRaw('text/plain', $report->filename, $data).'.csv';

        $file = fopen($filename, 'w');

        if (!$file) {
            throw new \Exception();
        }

        $head = array_keys((array) $report->body);
        $row = array_values((array) $report->body);

        fputcsv($file, $head);

        $query->chunk(100, function ($resources) use ($file, $row, $tm) {
            foreach ($resources as $resource) {
                fputcsv($file, json_decode($tm->renderRaw('text/plain', (string) json_encode($row), ['resource' => $resource]), true));
            }
        });

        $fm = new FileManager();
        $result = $fm->uploadFileFromFilesystem($filename, "reports");
        fclose($file);

        $result = $fm->create([]);
        $resource = $result->getResource();

        $resource
            ->addMedia($filename)
            ->addCustomHeaders([
                'ContentDisposition' => 'attachment; filename='.basename($filename).'',
                'ContentType' => 'text/csv'
            ])
            ->toMediaCollection("report");


        event(new ReportGenerated($report, $result->getResource(), $this->agent));
    }
}
