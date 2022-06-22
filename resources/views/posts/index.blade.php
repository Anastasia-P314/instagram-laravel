@extends('layouts.app')

@section('content')
<div class="container">
	@foreach($posts as $post)
	<div class="row">
		<div class="col-8 offset-3">
			<a href="/profile/{{$post->user->id}}"><img src="{{$post->image}}" class="w-75"></a>
		</div>
	</div>	

	<div class="row pt-2 pb-4">
		<div class="col-8 offset-3">
			<div>
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
	@endforeach

	<div class="row">
		<div class="col-12 d-flex justify-content-center">
			{{$posts->links('pagination::bootstrap-4')}}
		</div>
	</div>
</div>
@endsection