<?php

namespace App\Http\Controllers;

use App\Models\ProcedureType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProcedureTypeController extends Controller
{

    public function index()
    {
        $types = ProcedureType::orderBy('created_at','desc')->get();
        return view('procedureTypes.index',compact('types'));
    }


    public function create()
    {
        return view('procedureTypes.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'name_ar' => 'required|string'
        ]);
        $type = new ProcedureType();
        $type->name = $request->name;
        $type->name_ar = $request->name_ar;
        $type->save();
        return redirect()->back()->withStatus(__('alerts.backend.procedure-type.created'));
    }


    public function show(ProcedureType $procedureType)
    {
        return view('procedureTypes.show', compact('procedureType'));
    }


    public function edit(ProcedureType $procedureType)
    {
        return view('procedureTypes.edit', compact('procedureType'));
    }


    public function update(Request $request, ProcedureType $procedureType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'name_ar' => 'required|string'
        ]);
        $procedureType->name = $request->name;
        $procedureType->name_ar = $request->name_ar;
        return redirect()->back()->withStatus(__('alerts.backend.procedure-type.updated'));

    }


    public function destroy(ProcedureType $procedureType)
    {
        $procedureType->delete();
        return redirect()->back()->withStatus(__('alerts.backend.procedure-type.deleted'));
    }
}
