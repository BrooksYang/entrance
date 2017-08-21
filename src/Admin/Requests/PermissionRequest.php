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
            'type'      => 'required',
            'module_id' => 'required_if:type,0',
            'group_id'  => 'required_if:type,1',
            'icon'      => 'required_if:type,1',
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
            'name.required'         => '请输入权限名称',
            'name.unique'           => '该权限已存在',
            'type.required'         => '请选择权限所属类型',
            'module_id.required_if' => '请选择模块',
            'group_id.required_if'  => '请选择板块',
            'icon.required_if'      => '请选择菜单图标',
            'method.required'       => '请选择请求方法',
            'method.in'             => '请求方法不正确',
            'uri.required'          => '请输入URI',
            'uri.permission'        => '该权限已存在',
        ];
    }
}
