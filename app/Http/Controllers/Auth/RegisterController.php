<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if ($request->isMethod('get')) {
            session(['url.registerTo' => url()->previous()]);
        }
        $this->middleware('guest');
    }

    // public function redirectTo()
    // {
    //     return session()->get('url.registerTo');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'regex:/^1[0-9]{10}$/', 'unique:user'],
            'verify_code' => ['required', function ($attribute, $value, $fail) use ($data) {
                if (!SmsHelper::verify($data['mobile'], $value, 'register')) {
                    $fail('手机验证码错误');
                }
            }],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z][a-zA-Z0-9_\-]+$/', 'min:3', 'max:30', 'unique:user'],
            'nickname' => ['required', 'string', 'min:3', 'max:30', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'max:64'],
        ], [
            'name.required' => '用户名必填',
            'name.unique' => '用户名已存在',
            'nickname.required' => '昵称必填',
            'nickname.unique' => '昵称已存在',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'password' => Hash::make($data['password']),
        ]);
        SmsHelper::clear($data['mobile']);
    }
}
