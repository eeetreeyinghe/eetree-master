<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'debug command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');
        if (method_exists($this, $type)) {
            $this->$type();
        } else {
            $this->index();
        }
    }

    private function index()
    {
        var_dump(bcrypt('test'));
    }

    private function resetRecommendOrder()
    {
        $recommends = \App\Models\Recommend::select('id', 'area_id')->orderBy('area_id', 'asc')->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $order = 0;
        $areaId = 0;
        $recommends->each(function ($recommend, $key) use (&$order, &$areaId) {
            if ($areaId != $recommend->area_id) {
                $areaId = $recommend->area_id;
                $order = 0;
            }
            $recommend->update(['order' => ++$order]);
        });
    }

    private function resetCaseOrder()
    {
        $draftCases = \App\Models\ProjectCaseDraft::select('id', 'project_draft_id')->orderBy('project_draft_id', 'asc')->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $order = 0;
        $orderId = 0;
        $draftCases->each(function ($case, $key) use (&$order, &$orderId) {
            if ($orderId != $case->project_draft_id) {
                $orderId = $case->project_draft_id;
                $order = 0;
            }
            $case->update(['order' => ++$order]);
        });
        $cases = \App\Models\ProjectCase::select('id', 'project_id')->orderBy('project_id', 'asc')->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $order = 0;
        $orderId = 0;
        $cases->each(function ($case, $key) use (&$order, &$orderId) {
            if ($orderId != $case->project_id) {
                $orderId = $case->project_id;
                $order = 0;
            }
            $case->update(['order' => ++$order]);
        });
    }
}
