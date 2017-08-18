<?php

namespace BrooksYang\Entrance\Controllers;

use BrooksYang\Entrance\Models\Group;
use BrooksYang\Entrance\Requests\GroupRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
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
        $groups = Group::search($keyword)
            ->orderBy('order')
            ->paginate();

        return view('entrance::entrance.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrance::entrance.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $group = new Group();
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->save();
        $group->order = Group::max('order') + 1;
        $group->save();

        return redirect('auth/groups');
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

        $group = Group::findOrFail($id);

        return view('entrance::entrance.group.create', compact('group', 'editFlag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->save();

        return redirect('auth/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        if (empty($group)) {
            return response()->json(['code' => 1, 'error' => '该板块不存在']);
        }

        if (!$group->modules->isEmpty()) {
            return response()->json(['code' => 1, 'error' => '请先删除该板块下的模块']);
        }

        $group->delete();

        Group::where('order', '>', $group->order)->decrement('order');

        return response()->json();
    }

    /**
     * 移动板块
     *
     * @param $groupId
     * @param $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function move($groupId, $action)
    {
        $group = Group::findOrFail($groupId);

        // 排序大于1，允许上移
        if ($group->order >=2 && $action == 'up') {
            Group::where('order', $group->order - 1)->increment('order');
            $group->decrement('order');
        }

        // 排序小于最大值，允许下移
        if ($group->order < Group::max('order') && $action == 'down') {
            Group::where('order', $group->order + 1)->decrement('order');
            $group->increment('order');
        }

        // 清空菜单缓存
        \Cache::tags('user_menus')->flush();

        return redirect('auth/groups');
    }
}
