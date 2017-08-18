<?php

namespace BrooksYang\Entrance\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $id = @$request->route()->parameter('user')->id;
        $method = $request->method();

        if ($method == 'POST') {
            return [
                'name'     => "required|alpha_dash|unique:users,name,$id",
                'email'    => "required|email|unique:users,email,$id",
                'password' => 'required|min:6|alpha_dash',
                'role_id'  => 'required',
            ];
        }

        return [
            'name'     => "required|alpha_dash|unique:users,name,$id",
            'email'    => "required|email|unique:users,email,$id",
            'role_id'  => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'       => '请输入用户名',
            'name.unique'         => '用户名已存在',
            'name.alpha_dash'     => '用户名不能包含特殊字符',
            'email.required'      => '请输入邮箱',
            'email.unique'        => '邮箱已存在',
            'email.email'         => '邮箱地址不合法',
            'password.required'   => '请输入密码',
            'password.min'        => '密码至少包含6个字符',
            'password.alpha_dash' => '密码不能包含特殊字符',
            'role_id.required'    => '请选择管理员角色',
        ];
    }
}
