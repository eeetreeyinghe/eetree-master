<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Doc;
use Illuminate\Console\Command;

class Sitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate sitemap';

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
        if ($this->argument('type') == 'xml') {
            $this->xml();
        } else {
            $this->html();
        }
    }

    private function html()
    {
        $sitename = config('app.name');
        $begin = <<<EOT
<!DOCTYPE html>
<head>
<title>[sitename] - 网站地图</title>
<meta http-equiv="Content-type" content="text/html;" charset="UTF-8" />
<style>a:link{text-decoration: none;}a:visited{text-decoration:none;}a:active{text-decoration:none;}
body{font-family: Arial, "微软雅黑";font-size: 13px;}
ul, li{margin:0px; padding:0px; list-style:none;}ul{width:90%;margin-left: auto;margin-right: auto;}.title{width:100%;font-size: 18px;}
.lks a {font-size:13px;border:1px solid #e4e4e4;width:150px;height:30px;line-height:30px;float:left;padding-left:5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.lks span {font-size:10px;width:40px;background-color:#e4e4e469;margin-bottom:3px;text-align:center;border-left:1px solid #e4e4e4;float:left;border-top:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;}
.lks {line-height:30px;font-size:16px;height:32px;width:200px;text-align:left;float:left;margin-bottom:3px;}
</style>
</head><body align="center">
<div style="display: table;width: 100%;"><ul><li class="title"><h3>[sitename]网站地图</h3></li>

EOT;
        $end = '</ul></div><br><br><br><br><br><br></body></html>';
        $row = '<li class="lks"><a href="%s" title="%s" target="_blank">%s</a></li>' . "\n";
        $file = fopen(base_path('public/sitemap.html'), 'w') or exit('Unable to open file!');
        fwrite($file, str_replace('[sitename]', $sitename, $begin));
        fwrite($file, sprintf($row, route('indexpage'), $sitename, $sitename));
        //category
        $categories = $this->getCategories(Category::getTree());
        foreach ($categories as $category) {
            fwrite($file, sprintf($row, $category['url'], $category['name'], $category['name']));
        }
        //doc
        $offset = 0;
        $limit = 100;
        while (1) {
            $docs = Doc::whereNotNull('publish_at')
                ->select('id', 'title')
                ->offset($offset)
                ->limit($limit)
                ->get();
            if (empty($docs) || $docs->isEmpty()) {
                break;
            }
            foreach ($docs as $doc) {
                fwrite($file, sprintf($row, route('doc.detail', ['doc' => $doc->id]), $doc->title, $doc->title));
            }
            if (count($docs) > $limit) {
                break;
            }
            $offset += $limit;
        }
        fwrite($file, $end);

        fclose($file);
    }

    private function xml()
    {
        $sitename = config('app.name');
        $begin = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
>

EOT;
        $end = '</urlset>';
        $row = <<<EOT
<url>
    <loc>%s</loc>
    <priority>0.5</priority>
    <lastmod>%s</lastmod>
    <changefreq>weekly</changefreq>
</url>

EOT;
        $file = fopen(base_path('public/sitemap.xml'), 'w') or exit('Unable to open file!');
        $date = date('Y-m-d');
        fwrite($file, $begin);
        fwrite($file, sprintf($row, route('indexpage'), $date));
        //category
        $categories = $this->getCategories(Category::getTree());
        foreach ($categories as $category) {
            fwrite($file, sprintf($row, $category['url'], $date));
        }
        //doc
        $offset = 0;
        $limit = 100;
        while (1) {
            $docs = Doc::whereNotNull('publish_at')
                ->select('id', 'title')
                ->offset($offset)
                ->limit($limit)
                ->get();
            if (empty($docs) || $docs->isEmpty()) {
                break;
            }
            foreach ($docs as $doc) {
                fwrite($file, sprintf($row, route('doc.detail', ['doc' => $doc->id]), $date));
            }
            if (count($docs) > $limit) {
                break;
            }
            $offset += $limit;
        }
        fwrite($file, $end);

        fclose($file);
    }

    private function getCategories($categories)
    {
        $result = [];
        $categories->each(function ($item, $key) use (&$result) {
            $result[] = [
                'name' => $item->name,
                'url' => route('category.list', ['category' => $item->id]),
            ];
            if ($item->has('children') && $item->children->isNotEmpty()) {
                $result = array_merge($result, $this->getCategories($item->children));
            }
        });
        return $result;
    }
}
