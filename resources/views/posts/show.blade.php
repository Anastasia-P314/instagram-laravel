@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-8">
			<img src="{{$post->image}}" class="w-75">
		</div>

		<div class="col-4">
			<div>
				<div class="d-flex" >
					<div class="pt-2" style="padding-right: 10px;">			
						<img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width: 40px;">
					</div>
					<div class="pt-2">
						<div class="d-flex" style="font-weight: bold">
							<a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none pt-2" style="padding-right:10px;">
								{{$post->user->username}}
							</a>
							<!-- <a href="" style="text-decoration: none">Follow</a> -->
							<follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
						</div>
					</div>
				</div>

				<hr>

				<p>
					<span style="font-weight: bold; padding-right: 3px;">
						<a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none">
							{{$post->user->username}}
						</a>
					</span>{{$post->caption}}
				</p>
			</div>			
		</div>
		
	</div>
</div>
@endsection