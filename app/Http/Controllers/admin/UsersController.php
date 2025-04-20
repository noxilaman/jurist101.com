<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage = 10;
        $users = User::latest()->paginate($perpage);

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $roleList = Role::pluck('name','id');
        $user = User::findOrFail($id);
        // dd($roleList );
        return view('admin.users.edit',compact('user','roleList'));
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
        $input = $request->all();
        
        $user = User::findOrFail($id);
        if(!empty($input['name'])){
            $user->name = $input['name'];
        }
        if(!empty($input['email'])){
            $user->email = $input['email'];
        }
        if(!empty($input['username'])){
            $user->username = $input['username'];
        }
        if(!empty($input['password'])){
            $user->password = Hash::make($input['password']);
        }
        if(!empty($input['i_role'])){
            $user->i_role = $input['i_role'];
        }
        $user->update();
        return redirect('admin/users/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bookmark::where('user_id',$id)->delete();
        User::findOrFail($id)->delete();
        return redirect('admin/users/');
    }
}
