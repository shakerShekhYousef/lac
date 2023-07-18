<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return SectionResource::collection(Section::paginate(10));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string:max:255',
            'translate' => 'required|string',
            'conversation' => 'required|string',
            'name_ar' => 'required|string:max:255',
            'translate_ar' => 'required|string',
            'conversation_ar' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $section = new Section();
        $section->name = $request->name;
        $section->translate = $request->translate;
        $section->conversation = $request->conversation;
        $section->name_ar = $request->name_ar;
        $section->translate_ar = $request->translate_ar;
        $section->conversation_ar = $request->conversation_ar;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageSection = $this->UploadImage($image);
        } else {
            $imageSection = 'default.png';
        }
        $section->image = $imageSection;
        $section->save();
        if ($section) {
            return response()->json('Section Created', 200);
        }
    }


    public function show(Section $section)
    {
        return response()->json($section, 200);
    }


    public function edit(Section $section)
    {
        return response()->json($section, 200);
    }


    public function update(Request $request, Section $section)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string:max:255',
            'translate' => 'string',
            'conversation' => 'string',
            'name_ar' => 'string:max:255',
            'translate_ar' => 'string',
            'conversation_ar' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $section->name = $request->name;
        $section->translate = $request->translate;
        $section->conversation = $request->conversation;
        $section->name_ar = $request->name_ar;
        $section->translate_ar = $request->translate_ar;
        $section->conversation_ar = $request->conversation_ar;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageSection = $this->UploadImage($image);
        } else {
            $imageSection = $section->image;
        }
        $section->image = $imageSection;
        $section->save();
        if ($section) {
            return response()->json('Section Updated', 200);
        }
    }


    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json('Section Deleted', 200);
    }

    // Upload image function
    public function UploadImage($image)
    {
        //get file name with extention
        $filenameWithExt = $image->getClientOriginalName();
        //get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //GET EXTENTION
        $extention = $image->getClientOriginalExtension();
        //file name to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extention;
        //upload image
        $path = $image->storeAs('public/images/sections/', $fileNameToStore);
        return $fileNameToStore;
    }
}
