<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group user
 * 我的地址
 */
class AddressController extends ApiController
{
    /**
     * list address
     */
    public function index(Request $request)
    {
        $addresses = Address::where('user_id', Auth::id())->orderBy('id', 'asc')->get();
        return $this->success(AddressResource::collection($addresses));
    }

    /**
     * add address
     * @bodyParam  name string 姓名
     * @bodyParam  mobile string 手机
     * @bodyParam  province string 省
     * @bodyParam  city string 市
     * @bodyParam  district string 区
     * @bodyParam  address string 地址
     */
    public function store(AddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        if ($data['default'] == 1) {
            Address::where([
                ['user_id', Auth::id()],
                ['default', 1],
            ])->update(['default' => 0]);
        }
        $address = Address::create($data);
        return $this->success(new AddressResource($address));
    }

    /**
     * update address
     * @urlParam address 地址ID
     * @bodyParam  name string 姓名
     * @bodyParam  mobile string 手机
     * @bodyParam  province string 省
     * @bodyParam  city string 市
     * @bodyParam  district string 区
     * @bodyParam  address string 地址
     */
    public function update(Address $address, AddressRequest $request)
    {
        $data = $request->validated();
        if ($data['default'] == 1) {
            Address::where([
                ['user_id', Auth::id()],
                ['default', 1],
            ])->update(['default' => 0]);
        }
        $address->update($data);
        return $this->success(new AddressResource($address));
    }

    /**
     * delete address
     * @urlParam address 地址ID
     */
    public function delete(Address $address)
    {
        $address->delete();

        return $this->success();
    }
}
