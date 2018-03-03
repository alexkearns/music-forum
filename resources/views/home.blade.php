@extends('layouts.master')

@section('content')
    <div>
        <h1>Welcome back {{ explode(' ',$user->name)[0] }}!</h1>
        <p class="lead mb-4">Create threads and posts about the LCR below!</p>

        <hr/>

        @if(!empty($threads) && $threads->count())
            <a class="btn btn-dark mb-2" href={{ route('showNewThreadForm') }} >
                <i class="fas fa-plus"></i> New Thread
            </a>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Thread Name</th>
                            <th scope="col">Started By</th>
                            <th scope="col">Replies</th>
                            <th scope="col">Most Recent Post</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    @foreach($threads as $thread)
                        <tbody>
                        <tr>
                            <th scope="row">
                                <a class="text-dark" href="{{ route('thread', $thread->id)}}">{{ $thread->title }}
                                </a>
                            </th>
                            <td>
                                {{ $thread->user->name}}<br>
                                <small class="text-muted">{{ $thread->created_at }}</small>
                            </td>
                            <td>{{ $thread->posts->count() }}</td>
                            @if ($thread->getRecentPost())
                                <td>
                                    {{ $thread->getRecentPost()->user->name }}<br>
                                    <small class="text-muted">{{ $thread->getRecentPost()->created_at }}</small>
                                </td>
                            @else
                                <td>No Posts</td>
                            @endif
                            <td>
                                @if ($user->can('delete-any-thread') || ($user->createdThread($thread)))
                                    <a href="{{ url('/thread/delete/' . $thread->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        @else
            <h1 class="mb-3">(︶︹︶)</h1>
            <p class="lead mb-3">There are currently no threads</p>
            <a class="btn btn-dark" href={{ route('showNewThreadForm') }} >
                Create a new thread
            </a>
        @endif

        {{ $threads->render("pagination::bootstrap-4" )}}
    </div>
@endsection