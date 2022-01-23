<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //返回产品列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $sType = $request->input('sType');
        $where = [];
        if ($title) {
            $where[] = ['name', 'like', '%' . $title . '%'];
        }
        if ($sType !== 'all') {
            $sType = (int) $sType;
            $where[] = ['type', $sType];
        }
        $products = Product::with(['cloud', 'supplier'])->where($where)->orderBy('id', 'desc')->paginate(config('eetree.adminLimit'));
        return $this->success(ProductResource::collection($products));
    }

    //删除产品
    public function delete(Product $product)
    {
        $product->delete();
        return $this->success();
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        return $this->success(new ProductResource($product));
    }

    public function update(Product $product, ProductRequest $request)
    {
        $data = $request->validated();
        $product->update($data);
        return $this->success();
    }
}
