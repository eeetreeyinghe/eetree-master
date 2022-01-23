<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Wikikeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eetree:wikikeys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate wiki keywords';

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
        $file = fopen(storage_path('app/cusconfig/wikikeys'), 'r') or exit('Unable to open file!');

        Redis::del('eetree:wikikeys');
        while (!feof($file)) {
            $keyword = trim(fgets($file));
            $encode = mb_detect_encoding($keyword, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
            if ($encode && $encode !== 'UTF-8') {
                $keyword = mb_convert_encoding($keyword, 'UTF-8', $encode);
            }
            if (!empty($keyword)) {
                Redis::lpush('eetree:wikikeys', $keyword);
            }
        }

        fclose($file);
    }
}
