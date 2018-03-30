@extends('layouts.master')

@section('content')
    <div>
        <h1 class="mb-4">{{ $profile->name }}</h1>
        <h3>{{ $profile->email }} </h3>
        <h4>{{ $profile->role() }}</h4>
        <h5>Joined on {{ Carbon\Carbon::parse($profile->created_at)->format('d-m-Y') }}</h5>
        <h5>Total Threads: {{ $profile->threads->count() }}</h5>
        <h5>Total Posts: {{ $profile->posts->count() }}</h5>
        @if(\Auth::user()->id === $profile->id)
            @if($profile->{'2fa_secret'})
                <a href="{{route('profile.disable2FA')}}"><button class="btn btn-danger">Disable 2FA</button></a>
            @else
                <a href="{{route('profile.enable2FA')}}"><button class="btn btn-success">Enable 2FA</button></a>
            @endif
        @endif
    </div>

    <hr />

    <div>
    	<h4 class="mb-4 mt-4">Threads</h4>

        @if(!empty($profile->threads) && $profile->threads->count())
        	<div class="list-group">
    	    	@foreach ($profile->threads as $thread)
    	    		<a class="list-group-item list-group-item-action" href="{{ route('thread', $thread->id)}}">{{ $thread->title }}</a><br />
    	    	@endforeach
        	</div>
        @else
            <h1 class="mb-3">(︶︹︶)</h1>
        @endif
    </div>

    <div>
    	<h4 class="mb-4 mt-4">Posts</h4>

        @if(!empty($profile->posts) && $profile->posts->count())
        	<div class="list-group">
    	    	@foreach ($profile->posts as $post)
    	    		<a class="list-group-item list-group-item-action" href="{{ route('thread', $post->thread->id)}}">{{ $post->content }}</a><br />
    	    	@endforeach
        	</div>
        @else
            <h1 class="mb-3">(︶︹︶)</h1>
        @endif
    </div>
@endsection
