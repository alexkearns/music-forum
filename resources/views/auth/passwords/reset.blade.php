@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h1 class="display-4">Reset Password</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>
            <label for="email">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
            <label for="password-confirm">Confirm password</label>
        </div>

        <button type="submit" class="btn btn-block btn-primary">
            Reset Password
        </button>
    </form>
@endsection
