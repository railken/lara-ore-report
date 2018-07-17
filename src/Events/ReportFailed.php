<?php

namespace Railken\LaraOre\Events;

use Illuminate\Queue\SerializesModels;
use Exception;
use Railken\LaraOre\Report\Report;
use Railken\Laravel\Manager\Contracts\AgentContract;

class ReportFailed
{
    use SerializesModels;

    public $report;
    public $exception;
    public $agent;

    /**
     * Create a new event instance.
     *
     * @param \Railken\LaraOre\Report\Report                   $report
     * @param \Exception                 $exception
     * @param \Railken\Laravel\Manager\Contracts\AgentContract $agent
     */
    public function __construct(Report $report, Exception $exception, AgentContract $agent = null)
    {
        $this->report = $report;
        $this->exception = $exception;
        $this->agent = $agent;
    }
}
