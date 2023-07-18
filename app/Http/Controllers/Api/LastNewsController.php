<?php

namespace App\Http\Controllers\Api;

use App\Events\notifications\NotificationCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\LastNewsResource;
use App\Models\LastNews;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LastNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return LastNewsResource::collection(LastNews::orderBy('created_at','desc')->paginate(10));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'title_ar' => 'required|string|max:255',
            'body_ar' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
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
        if ($post) {
            //notification structure
            $message = 'New Post !';
            $users=User::all()->except(['1','2']);
            foreach ($users as $receiver){
                $receiver_id=$receiver->id;
                $notification = Notification::create([
                    'title' => 'Last News',
                    'text' => $message,
                    'user_id'=>$receiver_id,
                ]);
                event(new NotificationCreatedEvent($notification,$receiver_id));
            }
            return response()->json('Post Created', 200);
        }
    }


    public function show(LastNews $lastNews)
    {
        return response()->json($lastNews, 200);
    }


    public function edit(LastNews $lastNews)
    {

        return response()->json($lastNews, 200);
    }


    public function update(Request $request, LastNews $lastNews)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'body' => 'string',
            'title_ar' => 'string|max:255',
            'body_ar' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagePost = $this->UploadImage($image);
        } else {
            $imagePost = $lastNews->image;
        }
        $lastNews->title_ar = $request->title_ar;
        $lastNews->body_ar = $request->body_ar;
        $lastNews->image = $imagePost;
        $lastNews->save();
        if ($lastNews) {
            return response()->json('Post Updated', 200);
        }
    }


    public function destroy(LastNews $lastNews)
    {
        if ($lastNews->image) {
            $image = $lastNews->image;
            unlink(storage_path('app/public/images/posts/' . $image));
            $lastNews->delete();
        } else {
            $lastNews->delete();
        }
        return response()->json('Post Deleted', 200);

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
