<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|min:4',
            'email'=>'required|min:6',
            'password'=>'required|min:5'
        ]);
        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());
        //dd($request->all());
        return redirect('users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $roles = Role::get();
        $users = User::find($id);
        

        return view('users.edit', compact('roles' , 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $users = User::find($id);

        if($request->password){
            $request['password'] = bcrypt($request->password);
        }
        else{
            $request['password'] = $users->password;
        }

        $users->fill($request->all());
        $users->save();

        return redirect('users');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $users = User::find($id);
        if($users){
            $users->delete();
        }

        return redirect('users');
    }
}
