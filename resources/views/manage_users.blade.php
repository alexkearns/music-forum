@extends('layouts.master')

@section('content')
    <div>
        <h1>Manage Users</h1>
        <p class="lead">Here, you can manage the users that have signed up to the system. You'll be able to ban them as well as manage which are moderators.</p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="list-group mt-4 mb-5">
                @foreach($users as $user)
                    <a href="{{ route('manage-user', $user->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $user->name }}</h6>
                            <div>
                                @if($user->isA('admin'))<span class="badge badge-info">Admin</span>@endif
                                @if($user->isA('moderator'))<span class="badge badge-info">Moderator</span>@endif
                                @if($user->banned)<span class="badge badge-danger">Banned</span>@endif
                            </div>
                        </div>
                        <small>{{ $user->email }}</small>
                    </a>
                @endforeach
            </div>
            {{ $users->render("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection