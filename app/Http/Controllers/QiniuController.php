<?php

namespace App\Http\Controllers;

use App\Models\Cloud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Qiniu\Auth;

class QiniuController extends ApiController
{
    public function callback(Request $request, String $action)
    {
        if ($action === 'upload') {
            return $this->uploadCallback($request);
        }
    }

    private function uploadCallback($request)
    {
        $callbackBody = $request->all();
        $config = config('filesystems.disks.qiniu');
        $auth = new Auth($config['access_key'], $config['secret_key']);

        $contentType = 'application/json';
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $url = route('qiniu.callback', ['action' => 'upload']);
        $isQiniuCallback = $auth->verifyCallback($contentType, $authorization, $url, $callbackBody);
        if ($isQiniuCallback) {
            $fkey = $callbackBody['key'];
            $bucket = $callbackBody['bucket'];
            $fname = $callbackBody['name'];
            $userId = isset($callbackBody['uid']) ? (int) $callbackBody['uid'] : 0;

            $cfile = Cloud::where([
                ['fkey', $fkey],
                ['bucket', $bucket],
                ['storage', 'qiniu'],
            ])->first();
            if (empty($cfile)) {
                $cfile = Cloud::create([
                    'fname' => $fname,
                    'fkey' => $fkey,
                    'user_id' => $userId,
                    'fsize' => $callbackBody['fsize'],
                    'mime_type' => $callbackBody['mimeType'],
                    'bucket' => $callbackBody['bucket'],
                    'storage' => 'qiniu',
                ]);
            }
            $callbackBody['cloud_id'] = $cfile->id;
            $callbackBody['url'] = Storage::disk('qiniu')->getUrl($cfile->fkey);

            return $this->success($callbackBody);
        } else {
            return $this->failed('出错了');
        }
    }
}
