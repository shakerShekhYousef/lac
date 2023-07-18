<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::orderBy('created_at','desc')->get();
        return view('sections.index', compact('sections'));
    }


    public function create()
    {
        return view('sections.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string:max:255',
            'translate' => 'required|string',
            'conversation' => 'required|string',
            'name_ar' => 'required|string:max:255',
            'translate_ar' => 'required|string',
            'conversation_ar' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageSection = $this->UploadImage($image);
        } else {
            $imageSection = 'default.png';
        }
        $section = new Section();
        $section->name = $request->name;
        $section->translate = $request->translate;
        $section->conversation = $request->conversation;
        $section->name_ar = $request->name_ar;
        $section->translate_ar = $request->translate_ar;
        $section->conversation_ar = $request->conversation_ar;
        $section->image = $imageSection;
        $section->save();
        return redirect()->back()->withstatus(__('alerts.backend.section.created'));
    }


    public function show(Section $section)
    {
        return view('sections.show', compact('section'));
    }


    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }


    public function update(Request $request, Section $section)
    {
        $this->validate($request, [
            'name' => 'string|max:255',
            'translate' => 'string',
            'conversation' => 'string',
            'name_ar' => 'string|max:255',
            'translate_ar' => 'string',
            'conversation_ar' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageSection = $this->UploadImage($image);
        } else {
            $imageSection = $section->image;
        }
        $section->name = $request->name;
        $section->translate = $request->translate;
        $section->conversation = $request->conversation;
        $section->name_ar = $request->name_ar;
        $section->translate_ar = $request->translate_ar;
        $section->conversation_ar = $request->conversation_ar;
        $section->image = $imageSection;
        $section->save();
        return redirect()->back()->withstatus(__('alerts.backend.section.updated'));

    }


    public function destroy(Section $section)
    {
        if ($section->image) {
            $image = $section->image;
            unlink(storage_path('app/public/images/sections/' . $image));
            $section->delete();
        } else {
            $section->delete();
        }
        return redirect()->back()->withstatus(__('alerts.backend.section.deleted'));
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
