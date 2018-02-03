@extends('layouts.master')

@section('content')
    <main role="main" class="container">

        <div class="mb-4">
            <h1>Manage {{ $user->name }}</h1>
            <hr/>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('manage-user-action', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    @can('assign-admin')
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="admin" id="admin" {{ $user->isA('admin') ? 'checked' : '' }}>
                            <label class="form-check-label" for="admin">Administrator</label>
                        </div>
                    @endcan
                    @can('assign-moderator')
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="mod" id="mod" {{ $user->isA('moderator') ? 'checked' : '' }}>
                            <label class="form-check-label" for="mod">Moderator</label>
                        </div>
                    @endcan
                    @can('ban-user')
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="ban" id="ban" {{ $user->banned ? 'checked' : '' }}>
                        <label class="form-check-label" for="ban">Banned</label>
                    </div>
                    @endcan
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>

    </main>
@endsection