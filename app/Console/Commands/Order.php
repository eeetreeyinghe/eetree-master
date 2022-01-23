<?php

namespace App\Console\Commands;

use App\Helpers\Enums;
use App\Helpers\OrderHelper;
use App\Models\CronRec;
use App\Models\Order as DbOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Order extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eetree:order {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'eetree:order after,expires';

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
        $action = $this->argument('action');
        $this->$action();
    }

    private function after()
    {
        $orders = DbOrder::withTrashed()->where('job', 0)->where('status', Enums::key('order.status.PAID'))->limit(100)->get();
        if (!empty($orders)) {
            $orders->each(function ($order) {
                OrderHelper::afterOrder($order);
            });
        }
    }

    private function expires()
    {
        $lastId = 0;
        $row = CronRec::where('key', 'order_expire_last')->first();
        if (!$row) {
            $row = CronRec::create([
                'key' => 'order_expire_last',
                'value' => 0,
            ]);
        } else {
            $lastId = (int) $row->value;
        }

        $newId = $lastId;
        $orders = DbOrder::withTrashed()->where([
            ['id', '>', $lastId],
            ['created_at', '<', Carbon::now()->subHours(24)],
            ['status', Enums::key('order.status.SUBMIT')],
        ])->limit(100)->orderBy('id', 'asc')->get();
        if ($orders->isNotEmpty()) {
            $orders->each(function ($order) {
                if ($order->created_at->diffInHours() >= config('eetree.order.expires')) {
                    $order->status = Enums::key('order.status.OTHER');
                    $order->save();
                }
            });
            $newId = (int) $orders->last()->id;
        }
        if ($newId > $lastId) {
            $row->value = $newId;
            $row->save();
        }
    }
}
