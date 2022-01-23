<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Wx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wx {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weixin: createMenu';
    protected $elastic;
    protected $client;

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
        $this->$type();
    }

    private function createMenu()
    {
        $app = \EasyWeChat::officialAccount();
        $buttons = [
            [
                "name" => "菜单名称",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "设计资源",
                        "url" => "http://www.eetree.cn",
                    ],
                    [
                        "type" => "view",
                        "name" => "FPGA",
                        "url" => "http://www.stepfpga.com/doc/",
                    ],
                    [
                        "type" => "view",
                        "name" => "Verilog",
                        "key" => "http://www.eetree.cn/wiki/verilog",
                    ],
                    [
                        "type" => "view",
                        "name" => "树莓派",
                        "key" => "http://www.eetree.cn/wiki/rpi",
                    ],
                    [
                        "type" => "view",
                        "name" => "ESP32",
                        "key" => "http://www.eetree.cn/wiki/esp32",
                    ],
                ],
            ],
            [
                "type" => "view",
                "name" => "电赛资源",
                "key" => "https://www.eetree.cn/wiki/electronics_design_contest",
            ],
            [
                "name" => "板卡",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "扩展模块",
                        "url" => "http://www.stepfpga.com/doc/step_module",
                    ],
                    [
                        "type" => "view",
                        "name" => "功能底板",
                        "url" => "http://www.stepfpga.com/doc/step-baseboard",
                    ],
                    [
                        "type" => "view",
                        "name" => "核心板",
                        "key" => "http://www.stepfpga.com/doc/stepfpgaboard",
                    ],
                    [
                        "type" => "view",
                        "name" => "ESP32",
                        "key" => "http://www.stepfpga.com/doc/esp32",
                    ],
                    [
                        "type" => "view",
                        "name" => "树莓派",
                        "key" => "http://www.stepfpga.com/doc/rpi",
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);
    }
}
