<?php

namespace App\Http\Controllers;

use App\Models\Cloud;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UploadController extends ApiController
{
    public function docImage(\App\Models\DocDraft $docDraft, Request $request)
    {
        $maxSize = config('eetree.upload.max');
        $validator = Validator::make($request->all(), [
            'upload_file' => 'required|image|max:' . $maxSize,
        ], [
            'upload_file.required' => '请先选择要上传的图片',
            'upload_file.max' => '上传文件大小不能超过 ' . $maxSize . 'KB',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return [
                'errno' => 400,
                'msg' => $errors->first('upload_file'),
            ];
        }

        $file = $request->file('upload_file');

        $path = $file->store(
            'doc_file/' . $request->user()->id, 'public'
        );
        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => 'doc-image',
            'mime' => $file->getMimeType(),
            'pid' => $docDraft->id,
        ]);

        return [
            'errno' => 0,
            'msg' => 'ok',
            'data' => [
                'url' => asset('storage/' . $path),
            ],
        ];
    }

    public function avatar(Request $request)
    {
        $maxSize = config('eetree.upload.max');
        $request->validate([
            'avatar' => 'required|image|max:' . $maxSize,
        ], [
            'avatar.required' => '请先选择要上传的图片',
            'avatar.max' => '上传文件大小不能超过 ' . $maxSize . 'KB',
        ]);

        $file = $request->file('avatar');

        $path = $file->store(
            'avatar/' . date('Y-m'), 'public'
        );
        $user = Auth::user();
        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => 'avatar',
            'mime' => $file->getMimeType(),
            'pid' => $user->id,
        ]);
        $user->avatar = $path;
        $user->save();

        return $this->success([
            'url' => asset('storage/' . $path),
        ]);
    }

    public function html(Request $request)
    {
        $user = Auth::user();
        if (!$user->isAdmin()) {
            return $this->failed('无权限');
        }
        $maxSize = config('eetree.upload.max');
        $request->validate([
            'file' => 'required|file|mimes:html|max:' . $maxSize,
        ], [
            'file.required' => '请选择要上传的文件',
            'file.max' => '上传文件大小不能超过 ' . $maxSize . 'KB',
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'html/' . date('Y-m'), 'public'
        );
        $cloud = Cloud::create([
            'fname' => $file->getClientOriginalName(),
            'fkey' => $path,
            'user_id' => $user->id,
            'fsize' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'bucket' => '',
            'storage' => 'local',
        ]);

        return $this->success([
            'cloud_id' => $cloud->id,
            'name' => $cloud->fname,
            'url' => asset('storage/' . $path),
        ]);
    }
}
