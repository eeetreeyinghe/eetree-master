<?php

namespace App\Http\Controllers;

use App\Models\Xform;
use App\Models\XformData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group project
 * 表单
 */
class XformController extends ApiController
{
    /**
     * get form info
     */
    public function show(Xform $xform)
    {
        $exist = XformData::where([
            ['user_id', Auth::id()],
            ['xform_id', $xform->id],
        ])->first();
        return $this->success([
            'data' => $exist ? null : $xform->data,
        ]);
    }

    /**
     * save user form
     */
    public function save(Xform $xform, Request $request)
    {
        $uid = Auth::id();
        $exist = XformData::where([
            ['user_id', $uid],
            ['xform_id', $xform->id],
        ])->first();
        if ($exist) {
            return $this->success();
        }
        $data = $request->all();
        XformData::create([
            'xform_id' => $xform->id,
            'user_id' => $uid,
            'data' => $data,
        ]);
        return $this->success();
    }
}
