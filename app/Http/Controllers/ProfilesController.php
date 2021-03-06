<?php

namespace App\Http\Controllers;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $authUser = (auth()->user()) ? auth()->user()->id : false;
        $postsCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        return view('profiles.index', compact('user', 'follows', 'authUser', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')){
            $image_path = '/storage/'.request('image')->store('profile', 'public');

            $image = Image::make(public_path("$image_path"))->fit(1000, 1000);
            $image->save();

            //$image_path = ['image' => $image_path];


            $uploadedFileUrl = Cloudinary::upload(request('image')->getRealPath(), 
            ["folder" => "profile", 
            "width" => 1000, "height" => 1000, 'crop' => 'fill']
            )->getSecurePath();

            $image_path = ['image' => $uploadedFileUrl];
        }

        auth()->user()->profile()->update(array_merge(
            $data, 
            $image_path ?? []
        ));

        return redirect('/profile/'.$user->id);
    }

}
