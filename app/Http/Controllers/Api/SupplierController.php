<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SupplierRequest;
use App\Http\Resources\Api\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //返回厂商列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $id = $request->input('id');
        $where = [];
        if ($title) {
            $where[] = ['name', 'like', '%' . $title . '%'];
        }
        $query = Supplier::with(['cloud'])->where($where);
        if ($id) {
            $query->orWhere('id', $id);
        }
        $suppliers = $query->orderBy('id', 'desc')->paginate(config('eetree.adminLimit'));
        return $this->success(SupplierResource::collection($suppliers));
    }

    //删除厂商
    public function delete(Supplier $supplier)
    {
        $supplier->delete();
        return $this->success();
    }

    public function store(SupplierRequest $request)
    {
        $data = $request->validated();
        $supplier = Supplier::create($data);
        return $this->success(new SupplierResource($supplier));
    }

    public function update(Supplier $supplier, SupplierRequest $request)
    {
        $data = $request->validated();
        $supplier->update($data);
        return $this->success(new SupplierResource($supplier));
    }
}
