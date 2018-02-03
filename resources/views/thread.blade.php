@extends('layouts.master')

@section('content')
    <main role="main" class="container">
        <div>
            <h1>{{ $thread->title }}</h1>

            @foreach($posts as $post)
            	<div class="card">
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
        </div>
    </main>
@endsection