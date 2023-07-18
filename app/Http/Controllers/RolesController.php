<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::orderBy('created_at','desc')->get();
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        return view('roles.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'name_ar' => 'required|string',
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->name_ar = $request->name_ar;
        $role->save();
        return redirect()->back()->withstatus(__('alerts.backend.roles.created'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'string',
            'name_ar' => 'string',
        ]);
        $role->name = $request->name;
        $role->name_ar = $request->name_ar;
        $role->save();
        return redirect()->back()->withstatus(__('alerts.backend.roles.updated'));
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withstatus(__('alerts.backend.roles.deleted'));
    }
}
