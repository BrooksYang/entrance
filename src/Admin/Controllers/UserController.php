<?php

namespace BrooksYang\Entrance\Controllers;

use App\User;
use BrooksYang\Entrance\Models\Role;
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
        $users = User::with('role')->where('name', 'like', "%$keyword%")->get();

        return view('entrance::entrance.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

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
        $user = new User();
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $editFlag = true;
        $roles = Role::all();

        return view('entrance::entrance.user.create', compact('user', 'editFlag', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
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
        $user = User::find($id);
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
