<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Enums;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //返回用户列表
    public function index(Request $request)
    {
        $q = $request->input('q');
        $sType = $request->input('sType');
        $where = [];
        if (!empty($q)) {
            $where[] = ['nickname', 'like', '%' . $q . '%'];
        }
        if ($sType !== 'all') {
            $sType = (int) $sType;
            $where[] = ['user_type', $sType];
        }
        $users = User::where($where)->orderBy('created_at', 'desc')->paginate(config('eetree.adminLimit'));
        return $this->success(UserResource::collection($users));
    }

    //删除用户
    public function delete(User $user)
    {
        if ($user->user_type != Enums::key('user.types.EDITOR')) {
            return $this->failed('不能删除注册用户');
        }
        $user->delete();
        return $this->success();
    }

    public function update(User $user, UserRequest $request)
    {
        $data = $request->validated();
        if ($data['user_type'] === Enums::key('user.types.EDITOR') && preg_match('/^1[0-9]{10}$/', $user->mobile)) {
            return $this->failed('该用户不是从后台添加的编辑');
        }
        if (isset($data['password'])) {
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
        }
        if (!empty($data)) {
            $user->update($data);
        }
        return $this->success(new UserResource($user));
    }

    //用户注册
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->validated());
        $user->user_type = Enums::key('user.types.EDITOR');
        $user->mobile = 'e' . time();
        $user->avatar = '/img/avatar.jpeg';
        $user->save();
        return $this->success(new UserResource($user));
    }
}
