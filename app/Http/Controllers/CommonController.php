<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * @group common
 * 通用接口
 */
class CommonController extends ApiController
{
    /**
     * get qiniu upload token
     */
    public function qnUploadToken(Request $request)
    {
        $type = $request->input('type');
        $fsizeLimit = config('eetree.upload.max');
        if ($type == 'file') {
            $fsizeLimit = config('eetree.upload.maxFile');
        }
        $token = Storage::disk('qiniu')->getUploadToken(null, 3600, [
            'fsizeLimit' => $fsizeLimit,
            'callbackUrl' => route('qiniu.callback', ['action' => 'upload']),
            'callbackBody' => '{"key":"$(key)","hash":"$(etag)","fsize":$(fsize),"mimeType":$(mimeType),"bucket":"$(bucket)","name":"$(x:name)","uid":' . Auth::id() . '}',
            'callbackBodyType' => 'application/json',
        ]);
        return $this->success(['token' => $token]);
    }

    public function enums(Request $request)
    {
        $t = $request->input('t');
        $key = (string) $request->term;
        if (!in_array($key, ['project', 'product.types'])) {
            return $this->failed('无权限');
        }
        if ($t == 'all') {
            return $this->success(Enums::get($key));
        } else {
            return $this->success(Enums::values($key));
        }
    }
}
