<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{

    public function index()
    {
        return RoleResource::collection(Role::paginate(10));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_ar' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $role = new Role();
        $role->name = $request->name;
        $role->name_ar = $request->name_ar;
        $role->save();
        if ($role) {
            return response()->json('Role Created', 200);
        }
    }

    public function show(Role $role)
    {
        return response()->json($role, 200);
    }

    public function edit(Role $role)
    {
        return response()->json($role, 200);
    }


    public function update(Request $request, Role $role)
    {
        $validate = $this->validate($request, [
            'name' => 'string',
            'name_ar' => 'string',
        ]);
        $role->name = $request->name;
        $role->name_ar = $request->name_ar;
        $role->save();
        if ($role) {
            return response()->json('Role Updated', 200);
        }
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json('Role Deleted');
    }
}
