<?php

namespace BrooksYang\Entrance\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleRequest extends FormRequest
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
        $table = config('entrance.roles_table');
        $id = $request->route()->parameter('role');

        return [
            'name'     => "required|unique:$table,name,$id",
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
            'name.required'     => '请输入角色名称',
            'name.unique'       => '该角色已存在',
        ];
    }
}
