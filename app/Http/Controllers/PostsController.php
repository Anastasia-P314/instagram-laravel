<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Resize;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //$posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2);

        $posts = count($users)>0 ? Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2) : Post::whereIn('id', [Post::count(), Post::count()-1])->latest()->paginate(2);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $image_path = '/storage/'.request('image')->store('uploads', 'public');

        $image = Image::make(public_path("$image_path"))->fit(1200, 1200);
        $image->save();


        $uploadedFileUrl = Cloudinary::upload(request('image')->getRealPath(), 
            ["folder" => "uploads", 
            "width" => 1200, "height" => 1200, 'crop' => 'fill']
            )->getSecurePath();

        $post = auth()->user()->posts()->create([
            'caption' => $data['caption'],
            //'image' => $image_path,
            'image' => $uploadedFileUrl,
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        return view('posts.show', compact('post', 'follows'));
    }
}
