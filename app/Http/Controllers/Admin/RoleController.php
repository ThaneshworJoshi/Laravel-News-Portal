<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Role List';

        $data = Role::all();

        return view('admin.role.list', compact('data', 'page_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Role Create';
        $permission = Permission::pluck('name', 'id');
        return view('admin.role.create', compact('permission', 'page_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'permission' => 'bail|required|array',
            'permission.*' => 'required|string'
            // 'description' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->action('Admin\RoleController@index')->with('success', 'Role Created Successfully');
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
        $page_name = 'Role Edit';
        $role = Role::find($id);
        $permission = Permission::pluck('name', 'id');
        $selectedPermission = DB::TABLE('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();
        return view('admin.role.edit', compact('role', 'permission', 'selectedPermission', 'page_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'permission' => 'bail|required|array',
            'permission.*' => 'required|string'
            // 'description' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        DB::TABLE('permission_role')->where('role_id', $id)->delete();

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->action('Admin\RoleController@index')->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::TABLE('permission_role')->where('role_id', $id)->delete();
        $role = Role::find($id);
        $role->delete();

        return redirect()->action('Admin\RoleController@index')->with('success', 'Role Deleted Successfully');
    }
}
