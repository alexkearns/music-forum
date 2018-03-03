@extends('layouts.master')

@section('content')
    <div>
        <h1 class="mb-4">
            <a href={{ route('thread', ['thread' => $post->thread->id]) }} ><i class="fas fa-arrow-alt-circle-left text-dark"></i></a>
            Edit Post
        </h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('updatePost') }}">
            {{ csrf_field() }}

            <input type="hidden" name="post_id" value={{ $post->id}}>

            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea rows="5" class="form-control lesson-edit" name="content" required>{{ $post->content }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">
                    Update Post
                </button>
            </div>
        </form>
    </div>
@endsection