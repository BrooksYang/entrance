<?php

namespace BrooksYang\Entrance\Controllers;

use BrooksYang\Entrance\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
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

        $roleModel = config('entrance.role');
        $roles = $roleModel::search($keyword)->paginate();

        return view('entrance::entrance.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrance::entrance.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $roleModel = config('entrance.role');
        $role = new $roleModel();
        $role->name = $request->get('name');
        $role->description = $request->get('description');
        $role->save();

        return redirect('auth/roles');
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

        $roleModel = config('entrance.role');
        $role = $roleModel::findOrFail($id);

        return view('entrance::entrance.role.create', compact('role', 'editFlag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $roleModel = config('entrance.role');
        $role = $roleModel::findOrFail($id);
        $role->name = $request->get('name');
        $role->description = $request->get('description');
        $role->save();

        return redirect('auth/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleModel = config('entrance.role');
        $role = $roleModel::find($id);
        if (empty($role)) {
            return response()->json(['code' => 1, 'error' => '该角色不存在']);
        }

        $role->delete();

        return response()->json();
    }

    /**
     * 查看角色拥有的权限
     *
     * @param $roleId
     * @return \Illuminate\Http\Response
     */
    public function permissions($roleId)
    {
        $groupModel = config('entrance.group');
        $moduleModel = config('entrance.module');
        $roleModel = config('entrance.role');

        // 按模块获取权限
        $modules = $moduleModel::with('permissions')->get();

        // 按板块获取权限
        $groups = $groupModel::with('permissions')->get();

        // 获取当前角色拥有的权限id
        $permissionIds = $roleModel::find($roleId)->permissions()->pluck('id')->toArray();

        return view('entrance::entrance.role.permissions', compact('roleId', 'modules', 'groups', 'permissionIds'));
    }

    /**
     * 更新角色权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function permissionsSync(Request $request, $id)
    {
        $roleModel = config('entrance.role');
        $role = $roleModel::findOrFail($id);

        $role->savePermissions($request->get('permissions'));

        return redirect('auth/roles');
    }
}
