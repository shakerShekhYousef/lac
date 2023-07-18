<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return AboutResource::collection(About::paginate(1));
    }

    public function create()
    {
        //
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


    public function edit(About $about)
    {
        return response()->json($about,200);
    }


    public function update(Request $request, About $about)
    {
        $validator=Validator::make($request->all(),[
            'description'=>'string',
            'description_ar'=>'string',
        ]);
        if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],200);
        }
        $about->update([
            'content'=>$request->description,
            'content_ar'=>$request->description_ar,
        ]);
        return response()->json('Content Updated',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
