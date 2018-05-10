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
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small><br />
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address"
                   value="{{ old('email') }}" required autofocus>
            <label for="email">Email address</label>
        </div>

        @if (config('app.env') == 'production')
            <div class="form-label-group">
                {!! NoCaptcha::display() !!}
            </div>
        @endif

        <button type="submit" class="btn btn-block btn-primary">
            Send Password Reset Link
        </button>
    </form>
@endsection
@section('scripts')
    @if (config('app.env') == 'production')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endsection
