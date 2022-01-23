<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocPublishResource;
use App\Models\DocPublish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DocPublishController extends ApiController
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $docPublishs = DocPublish::where([
            ['user_id', $userId],
        ])->orderBy('submit_at', 'desc')->paginate(config('eetree.limit'));

        return $this->success(DocPublishResource::collection($docPublishs));
    }

    public function preview(DocPublish $docPublish)
    {
        $value = Cache::pull('DocPublish:Preview:' . $docPublish->id);
        if (!$value) {
            abort(404);
        }
        return view('doc/preview', [
            'doc' => $docPublish,
        ]);
    }
}
