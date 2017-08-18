<?php

namespace BrooksYang\Entrance\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ModuleRequest extends FormRequest
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
        $table = config('entrance.modules_table');
        $id = $request->route()->parameter('module');

        return [
            'name'     => "required|unique:$table,name,$id",
            'icon'     => 'required',
            'group_id' => 'required',
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
            'name.required'     => '请输入模块名称',
            'name.unique'       => '该模块已存在',
            'icon.required'     => '请选择模块图标',
            'group_id.required' => '请选择模块区域',
        ];
    }
}
