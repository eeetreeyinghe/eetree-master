<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    public function enums(Request $request)
    {
        $t = $request->input('t');
        $key = (string) $request->term;
        if ($t == 'all') {
            return $this->success(Enums::get($key));
        } else {
            return $this->success(Enums::values($key));
        }
    }

    public function qnUploadToken()
    {
        $token = Storage::disk('qiniu')->getUploadToken(null, 3600, [
            'fsizeLimit' => config('eetree.upload.max') * 1024,
            'callbackUrl' => route('qiniu.callback', ['action' => 'upload']),
            'callbackBody' => '{"key":"$(key)","hash":"$(etag)","fsize":$(fsize),"mimeType":$(mimeType),"bucket":"$(bucket)","name":"$(x:name)"}',
            'callbackBodyType' => 'application/json',
        ]);
        return $this->success(['token' => $token]);
    }

    public function secret()
    {
        \Illuminate\Support\Facades\Cache::put('Common:Secret', 1, 60);
        return $this->success();
    }
}
