<?php

namespace BrooksYang\Entrance\Controllers;

use App\User;
use BrooksYang\Entrance\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        $userModel = config('entrance.user');
        $users = $userModel::with('role')->where('name', 'like', "%$keyword%")->get();

        return view('entrance::entrance.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleModel = config('entrance.role');
        $roles = $roleModel::all();

        return view('entrance::entrance.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userModel = config('entrance.user');
        $user = new $userModel();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->role_id = $request->get('role_id');
        $user->save();

        return redirect('auth/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param              $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userModel = config('entrance.user');
        $user = $userModel::findOrFail($id);

        $editFlag = true;
        $roleModel = config('entrance.role');
        $roles = $roleModel::all();

        return view('entrance::entrance.user.create', compact('user', 'editFlag', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param              $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $userModel = config('entrance.user');
        $user = $userModel::findOrFail($id);

        $password = $request->get('password');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($password) $user->password = bcrypt($password);
        $user->role_id = $request->get('role_id');
        $user->save();

        return redirect('auth/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = config('entrance.user');
        $user = $admin::find($id);
        if (empty($user)) {
            return response()->json(['code' => 1, 'error' => '该管理员不存在']);
        }

        if ($user->isAdministrator()) {
            return response()->json(['code' => 1, 'error' => '无法删除系统超级管理员']);
        }

        $user->delete();

        return response()->json();
    }
}
