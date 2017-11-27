<?php

namespace BrooksYang\Entrance\Controllers;

use BrooksYang\Entrance\Requests\ModuleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $moduleModel = config('entrance.module');
        $modules = $moduleModel::with('group')
            ->search($keyword)
            ->orderBy('id', 'desc')
            ->paginate();

        return view('entrance::entrance.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupModel = config('entrance.group');
        $groups = $groupModel::all();

        return view('entrance::entrance.module.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        $moduleModel = config('entrance.module');

        $module = new $moduleModel();
        $module->name = $request->get('name');
        $module->group_id = $request->get('group_id');
        $module->description = $request->get('description');
        $module->icon = $request->get('icon');
        $module->save();

        return redirect('auth/modules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFlag = true;

        $moduleModel = config('entrance.module');
        $module = $moduleModel::findOrFail($id);

        $groupModel = config('entrance.group');
        $groups = $groupModel::all();

        return view('entrance::entrance.module.create', compact('module', 'groups', 'editFlag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModuleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, $id)
    {
        $moduleModel = config('entrance.module');
        $module = $moduleModel::findOrFail($id);
        $module->name = $request->get('name');
        $module->group_id = $request->get('group_id');
        $module->description = $request->get('description');
        $module->icon = $request->get('icon');
        $module->save();

        return redirect('auth/modules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moduleModel = config('entrance.module');
        $module = $moduleModel::find($id);
        if (empty($module)) {
            return response()->json(['code' => 1, 'error' => '该模块不存在']);
        }

        if (!$module->permissions->isEmpty()) {
            return response()->json(['code' => 1, 'error' => '请先删除该模块下的权限']);
        }

        $module->delete();

        return response()->json();
    }
}
