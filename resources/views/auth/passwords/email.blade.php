@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h1 class="display-4">Reset Password</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->has('email'))
        <div class="alert alert-info">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address"
                   value="{{ old('email') }}" required autofocus>
            <label for="email">Email address</label>
        </div>

        <button type="submit" class="btn btn-block btn-primary">
            Send Password Reset Link
        </button>
    </form>
@endsection
