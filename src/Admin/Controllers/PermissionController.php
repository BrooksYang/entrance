<?php

namespace BrooksYang\Entrance\Controllers;

use BrooksYang\Entrance\Models\Module;
use BrooksYang\Entrance\Models\Permission;
use BrooksYang\Entrance\Requests\PermissionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
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
        $permissions = Permission::with('module')
            ->search($keyword)
            ->orderBy('module_id', 'desc')
            ->paginate();

        return view('entrance::entrance.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        $methods = Permission::$methods;

        return view('entrance::entrance.permission.create', compact('modules', 'methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->module_id = $request->get('module_id');
        $permission->method = $request->get('method');
        $permission->uri = trim($request->get('uri'), '/');
        $permission->is_visible = $request->get('is_visible');
        $permission->description = $request->get('description');
        $permission->save();

        return redirect('auth/permissions');
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

        $permission = Permission::findOrFail($id);

        $modules = Module::all();
        $methods = Permission::$methods;

        return view('entrance::entrance.permission.create', compact('permission', 'modules', 'methods', 'editFlag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->get('name');
        $permission->module_id = $request->get('module_id');
        $permission->method = $request->get('method');
        $permission->uri = trim($request->get('uri'), '/');
        $permission->is_visible = $request->get('is_visible');
        $permission->description = $request->get('description');
        $permission->save();

        return redirect('auth/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (empty($permission)) {
            return response()->json(['code' => 1, 'error' => '该权限不存在']);
        }

        $permission->delete();

        return response()->json();
    }
}
