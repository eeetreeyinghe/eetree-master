<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Requests\UserRequest;
use App\Http\Resources\RevenueResource;
use App\Models\Doc;
use App\Models\Project;
use App\Models\RevenueLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group user
 * 用户
 */
class UserController extends ApiController
{
    public function center()
    {
        return view('user/center');
    }

    public function home(User $user, $tab = null)
    {
        $tab = $tab == 'projects' ? 'projects' : 'docs';
        $totalDoc = $totalProject = 0;
        if ($tab == 'projects') {
            $items = Project::with(['cloud', 'user:id,avatar,nickname'])->where('user_id', $user->id)->whereNotNull('last_publish_at')->orderBy('last_publish_at', 'desc')->paginate(config('eetree.limit'));
            $totalProject = $items->total();
            $totalDoc = Doc::where('user_id', $user->id)->whereNotNull('publish_at')->count();
        } else {
            $items = Doc::where('user_id', $user->id)->whereNotNull('publish_at')->orderBy('publish_at', 'desc')->paginate(config('eetree.limit'));
            $totalDoc = $items->total();
            $totalProject = Project::where('user_id', $user->id)->whereNotNull('last_publish_at')->count();
        }
        return view('user/home', [
            'tab' => $tab,
            'showUser' => $user,
            'items' => $items,
            'totalItems' => [
                'doc' => $totalDoc,
                'project' => $totalProject,
            ],
        ]);
    }

    public function info(Request $request)
    {
        $user = Auth::user();
        return $this->success([
            'name' => $user->name,
            'mobile' => $user->mobile,
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            'alipay_account' => $user->alipay_account,
            'intro' => $user->intro,
            'revenue' => $user->revenue,
            'promote_revenue' => $user->promote_revenue,
            'is_admin' => $user->isAdmin(),
        ]);
    }

    /**
     * update user
     * @bodyParam  alipay_account string 支付宝账号
     * @bodyParam  intro string 个人简介
     */
    public function update(UserRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        return $this->success();
    }

    /**
     * my revenues
     * @urlParam year 年份
     */
    public function revenues(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $start = Carbon::create($year, 1, 1, 0, 0, 0);
        $end = Carbon::create($year, 1, 1, 0, 0, 0)->add(1, 'year');
        $revenues = RevenueLog::with(['orderItem.projectGoods.project'])->where([
            ['user_id', Auth::id()],
            ['type', Enums::key('order.type.NORMAL')],
            ['paid_at', '>=', $start],
            ['paid_at', '<', $end],
        ])->orderBy('paid_at', 'desc')->paginate(config('eetree.limit'));
        return $this->success(RevenueResource::collection($revenues));
    }

    public function find(Request $request)
    {
        $query = $request->input('q');
        $where = [
            ['nickname', 'like', '%' . $query . '%'],
        ];

        $limit = config('eetree.limit');
        $users = User::select('id', 'nickname', 'avatar')
            ->where($where)
            ->limit($limit)
            ->get();

        return $this->success($users);
    }
}
