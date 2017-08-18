<?php

namespace BrooksYang\Entrance\Requests;

use BrooksYang\Entrance\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PermissionRequest extends FormRequest
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
        $id = $request->route()->parameter('permission');
        $methods = implode(',', Permission::$methods);
        $method = $request->get('method');
        $uri = $request->get('uri');

        return [
            'name'      => "required",
            'module_id' => 'required',
            'method'    => "required|in:$methods",
            'uri'       => "required|permission:$method,$uri,$id",
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
            'name.required'      => '请输入权限名称',
            'name.unique'        => '该权限已存在',
            'module_id.required' => '请选择模块',
            'method.required'    => '请选择请求方法',
            'method.in'          => '请求方法不正确',
            'uri.required'       => '请输入URI',
            'uri.permission'     => '该权限已存在',
        ];
    }
}
