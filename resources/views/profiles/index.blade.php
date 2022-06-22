@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" style=" width: 100%;">
        </div>
        <div class="col-9 pt-5" style="padding-top: 50px;">
            <div class="d-flex inline justify-content-between align-items-baseline">
                <div class="d-flex pb-3">
                    <h4 class="w-100">{{ $user->username }}</h4>
     <!--                <button class="btn btn-primary ms-4">Follow</button> -->
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>

                @can('update', $user->profile)
                    <a href="/p/create">Add new post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit profile</a>
            @endcan
            <div class="d-flex" >
                <div style="padding-right: 40px;"><strong>{{ $postsCount }}</strong> posts</div>
                <div style="padding-right: 40px;"><strong>{{ $followersCount }}</strong> followers</div>
                <div style="padding-right: 40px;"><strong>{{ $followingCount }}</strong> following</div>
            </div>

            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <!-- <div>Laravel is a web application framework with expressive, elegant syntax</div> -->
            <div>{{ $user->profile->description }}</div>
            <div><a href="https://laravel.com/">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}">
                    <img src="{{$post->image}}" class="w-100">
                </a>
                
            </div>
        @endforeach
    </div>

</div>
@endsection
