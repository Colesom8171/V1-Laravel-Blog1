<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::get();
        //dd($roles);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|min:4'
        ]);
        // dd($request->all());
        $role_exist = Role::where( 'name' , $request->name)->first();

        if($role_exist){
            return redirect('roles/create');
        }

        $role = Role::create($request->all());

        return redirect('roles');
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
        //dd($id);
        $role = Role::find($id);
        //dd($role);
        //$role = Role:where('id',$id)->first();

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|min:4'
        ]);

        $role_exist = Role::where('name' , $request->name)->where('id', '!=', $id)->first();
        if($role_exist){
            return redirect('roles/create');
        }

        $role = Role::find($id);
        $role->fill($request->all());
        //$role->name = $request->name;
        $role->save();

        return redirect('roles');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::find($id);
        $role->delete();

        return redirect('roles');
    }
}
