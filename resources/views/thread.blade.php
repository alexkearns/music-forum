@extends('layouts.master')

@section('content')
    <div>
        <h1>
            <a href={{ route('home') }} >
                <i class="fas fa-arrow-alt-circle-left text-dark"></i>
            </a>
            {{ $thread->title }}
        </h1>

        @foreach($posts as $post)
        	<div class="card mb-3">
        		<div class="container-fluid">
			 		<div class="row">
			 			<div class="col-md-3 bg-light">
			 				<div class="card-body">
			    				<p class="card-text">
			    					{{ $post->getUser()->name }}<br>
			    					Posts: {{ $post->getUser()->getPosts()->count() }}<br>
			    					<small class="text-muted">{{ $post->created_at }}</small><br>
			    					<small class="text-muted">#{{ $loop->iteration }}</small>
			    				</p>
		    				</div>
		    			</div>
		    			<div class="col-md-9">
		    				<div class="card-body">
		    					<p class="card-text">{{ $post->content }}</p>
		    				</div>
		    			</div>
			    	</div>
		    	</div>
			</div>
        @endforeach

        <form class="form-horizontal" role="form" method="POST" action="{{ route('newPost') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" value={{ $thread->id }} name="thread_id">

                    <h3>New Post</h3>

                    <div id="content" class="form-group">
                        <textarea rows="5" class="form-control lesson-edit" name="content" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">
                            New Post
                        </button>
                    </div>
                </div>
            </div>
    	</form>
    </div>
@endsection