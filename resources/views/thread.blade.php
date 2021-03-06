@extends('layouts.master')

@section('content')
    <div>
        <h1 class="mb-4">
            <a href={{ route('home') }} ><i class="fas fa-arrow-alt-circle-left text-dark"></i></a>
            {{ $thread->title }}
        </h1>

        @if(!empty($posts) && $posts->count())
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 bg-light">
                                <div class="card-body">
                                    <p class="card-text">
                                        <a href="{{ route('profile', $post->user->id) }}"> {{ $post->user->name }}</a><br>
                                        Posts: {{ $post->user->posts->count() }}<br>
                                        <small class="text-muted">{{ $post->created_at }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text">{{ $post->content }}</p>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="card-body">
                                    @if ($user->createdPost($post))
                                        <p class="card-text">
                                            <a href="{{ url('/thread/post/edit/' . $post->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </p>
                                    @endif
                                    @if ($user->can('delete-any-post') || ($user->createdPost($post)))
                                        <p class="card-text">
                                            <button value="{{ url('/thread/post/delete/' . $post->id) }}" class="btn btn-sm btn-danger sa-delete"> <i class="fas fa-trash"></i>
                                            </button>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <hr />
            <h1 class="mb-3">(︶︹︶)</h1>
            <p class="lead mb-3">There are currently no posts</p>
            <hr />
        @endif
        <div class="mb-1 mt-1">
            {{ $posts->render("pagination::bootstrap-4" )}}
        </div>
        <form class="form-horizontal mt-5" role="form" method="POST" action="{{ route('saveNewPost') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" value={{ $thread->id }} name="thread_id">

                    <h3 class="mb-4">New Post</h3>

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
