<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Authors';
        $author = User::where('type', 2)->get();

        return view('admin.author.list', compact('author', 'page_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Author Create';
        $roles = Role::pluck('name', 'id');

        return view('admin.author.create', compact('roles', 'page_name'));
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
            'name' => 'bail|required|alpha_num|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|size:6',
            'roles' => 'required'
            // 'description' => 'required',
        ]);


        $author = new User();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->type = 2;

        $author->save();


        foreach ($request->roles as $value) {
            $author->attachRole($value);
        }
        return redirect()->action('Admin\AuthorController@index')->with('success', 'Author Created Successfully');
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
        $page_name = 'Edit Author';

        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $selectedRoles = DB::TABLE('role_user')->where('user_id', $id)->pluck('role_id')->toArray();

        return view('admin.author.edit', compact('user', 'roles', 'selectedRoles', 'page_name'));
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
            'name' => 'bail|required|alpha_num|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|size:6',
            'roles' => 'required'
            // 'description' => 'required',
        ]);

        $author = User::find($id);
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->save();

        DB::table('role_user')->where('user_id', $id)->delete();

        foreach ($request->roles as $value) {
            $author->attachRole($value);
        }
        return redirect()->action('Admin\AuthorController@index')->with('success', 'Author Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = User::find($id);
        $author->delete();
        DB::TABLE('role_user')->where('user_id', $id)->delete();
        return redirect()->action('Admin\AuthorController@index')->with('success', 'Author Deleted Successfully');
    }
}
