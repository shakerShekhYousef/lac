<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $contents = About::orderBy('created_at','desc')->get();
        return view('about.index', compact('contents'));
    }


    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'description_ar' => 'required|string',
        ]);
        $about = new About();
        $about->content = $request->description;
        $about->content_ar = $request->description_ar;
        $about->save();
        return redirect()->back()->withstatus('Content Created');
    }


    public function show(About $about)
    {
        return view('about.show', compact('about'));
    }

    public function edit(About $about)
    {
        return view('about.edit', compact('about'));
    }


    public function update(Request $request, About $about)
    {

        $this->validate($request, [
            'description' => 'string',
            'description_ar' => 'string'

        ]);
       $about->content=$request->description;
       $about->content_ar=$request->description_ar;
       $about->save();
        return redirect()->back()->withstatus(__('alerts.backend.about.updated'));
    }


    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->back()->withstatus(__('Content Deleted'));
    }
}
