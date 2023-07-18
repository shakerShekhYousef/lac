<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreatedEvent;
use App\Models\LastNews;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;

class LastNewsController extends Controller
{

    public function index()
    {
        $posts = LastNews::orderBy('created_at','desc')->get();
        return view('lastNews.index', compact('posts'));
    }


    public function create()
    {
        return view('lastNews.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'title_ar' => 'required|string|max:255',
            'body_ar' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post = new LastNews();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->title_ar = $request->title_ar;
        $post->body_ar = $request->body_ar;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagePost = $this->UploadImage($image);
        } else {
            $imagePost = 'default.png';
        }
        $post->image = $imagePost;
        $post->save();
        if($post){
            //notification structure
           
            $users=User::all()->except(['1','2']);
            foreach ($users as $receiver){
                $receiver_id=$receiver->id;
                $message = 'New Post !';
                $notification = Notification::create([
                    'title' => 'Last News',
                    'text' => $message,
                ]);
                event(new NotificationCreatedEvent($notification,$receiver_id));
            }

        }
        return redirect()->back()->withstatus(__('alerts.backend.posts.created'));
    }


    public function show(LastNews $lastNews)
    {
        return view('lastNews.show')->with('post', $lastNews);
    }

    public function edit(LastNews $lastNews)
    {
        return view('lastNews.edit')->with('post', $lastNews);
    }

    public function update(Request $request, LastNews $lastNews)
    {
        $this->validate($request, [
            'title' => 'string|max:255',
            'body' => 'string',
            'title_ar' => 'string|max:255',
            'body_ar' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagePost = $this->UploadImage($image);
        } else {
            $imagePost = $lastNews->image;
        }
        $lastNews->title = $request->title;
        $lastNews->body = $request->body;
        $lastNews->title_ar = $request->title_ar;
        $lastNews->body_ar = $request->body_ar;
        $lastNews->image = $imagePost;
        $lastNews->save();
        return redirect()->back()->withstatus(__('alerts.backend.posts.updated'));

    }


    public function destroy(LastNews $post)
    {
        if ($post->image !== 'default.png') {
            $image = $post->image;
            unlink(storage_path('app/public/images/posts/' . $image));
            $post->delete();
        } elseif ($post->image === 'default.png') {
            $post->delete();
        }
        return redirect()->back()->withstatus(__('alerts.backend.posts.deleted'));
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
        $path = $image->storeAs('public/images/posts/', $fileNameToStore);
        return $fileNameToStore;
    }
}
