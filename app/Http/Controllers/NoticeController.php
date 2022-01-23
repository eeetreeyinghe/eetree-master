<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends ApiController
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $notices = Notice::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(config('eetree.limit'));
        $noticeIds = [];
        foreach ($notices as $notice) {
            if ($notice->read == 0) {
                $noticeIds[] = $notice->id;
            }
        }
        if (!empty($noticeIds)) {
            // set read
            Notice::whereIn('id', $noticeIds)->update(['read' => 1]);
        }

        return $this->success(NoticeResource::collection($notices));
    }
}
