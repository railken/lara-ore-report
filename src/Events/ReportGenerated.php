<?php

namespace Railken\LaraOre\Events;

use Illuminate\Queue\SerializesModels;
use Railken\LaraOre\File\File;
use Railken\LaraOre\Report\Report;
use Railken\Laravel\Manager\Contracts\AgentContract;

class ReportGenerated
{
    use SerializesModels;

    public $report;
    public $file;
    public $agent;

    /**
     * Create a new event instance.
     *
     * @param \Railken\LaraOre\Report\Report                   $report
     * @param \Railken\LaraOre\File\File                       $file
     * @param \Railken\Laravel\Manager\Contracts\AgentContract $agent
     */
    public function __construct(Report $report, File $file, AgentContract $agent = null)
    {
        $this->report = $report;
        $this->file = $file;
        $this->agent = $agent;
    }
}
