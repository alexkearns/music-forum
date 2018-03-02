@extends('layouts.master')

@section('content')
    <div>
        <h1>Edit Thread</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('updatePost') }}">
            {{ csrf_field() }}
            
            <input type="hidden" name="post_id" value={{ $post->id}}>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Post</label>
                <div class="col-sm-10">
                    <textarea rows="5" class="form-control lesson-edit" name="content" required>{{ $post->content }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">
                    Update Thread
                </button>
            </div>
        </form>
    </div>
@endsection