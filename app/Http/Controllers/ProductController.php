<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @group project
 * 项目管理
 */
class ProductController extends ApiController
{
    /**
     * search product
     * @queryParam  q required 搜索词
     * @queryParam  type 类型（enums.product.types）
     */
    public function find(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type');
        $where = [
            ['name', 'like', $query . '%'],
        ];
        if ($type !== null) {
            $where[] = ['type', (int) $type];
        }

        $limit = config('eetree.limit');
        $products = Product::with(['cloud:id,fkey', 'supplier:id,name'])
            ->select('id', 'name', 'description', 'link', 'cloud_id', 'supplier_id')
            ->where($where)
            ->limit($limit)
            ->get();
        $exact = $products->first();
        if ($type == Enums::key('product.types.COMPONENT') && (!$exact || $exact->name !== $query)) {
            $half = floor($limit / 2);
            $total = $products->count();
            $vendorData = $this->fromEasyDatasheet($query, $total > $half ? $half : $limit - $total);
            $cutlen = $limit - count($vendorData);
        } else {
            $cutlen = $limit;
        }
        $result = $products->slice(0, $cutlen)->map(function ($product) use (&$cutlen) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->cloud->url,
                'description' => $product->description ?: ($product->supplier ? $product->supplier->name : ''),
                'link' => $product->link,
            ];
        });
        if (isset($vendorData)) {
            foreach ($vendorData as $row) {
                $result->push([
                    'vendor' => 'easyds',
                    'name' => $row['no'],
                    'image' => '',
                    'description' => $row['manu'],
                    'link' => $row['pdf_url'],
                ]);
            }
        }
        return $this->success($result);
    }

    private function fromEasyDatasheet($query, $limit)
    {
        return [];
        $url = 'https://easydatasheet.cn/public_api/search?appkey=qCdQLqSWXpGcan0S&no=';
        $response = Http::withHeaders(['User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'])->get($url . $query);
        $json = $response->json();
        if (isset($json['status']) && $json['status'] == 'ok') {
            return array_slice($json['results'], 0, $limit);
        }
        return [];
    }
}
