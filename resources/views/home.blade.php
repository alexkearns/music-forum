@extends('layouts.master')

@section('content')
    <div>
        <h1>Welcome back {{ explode(' ',$user->name)[0] }}!</h1>
        <p class="lead">Create threads and posts about the LCR below!</p>

        <a class="btn btn-dark mb-2" href={{ route('showNewThreadForm') }} >
            <i class="fas fa-plus"></i> New Thread
        </a>

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
                        {{ $thread->getUser()->name}}<br>
                        <small class="text-muted">{{ $thread->created_at }}</small>
                    </td>
                    <td>{{ $thread->getPosts()->count() }}</td>
                    @if ($thread->getRecentPost())
                        <td>
                            {{ $thread->getRecentPost()->getUser()->name }}<br>
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
@endsection