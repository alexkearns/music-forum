@extends('layouts.auth')

@section('card-content')
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="text-center mb-4">
            <h3>Log In</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <small>{{ $error }}</small><br />
                @endforeach
            </div>
        @endif

        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address"
                   value="{{ old('email') }}" required autofocus>
            <label for="email">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember"
                   name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        @if (config('app.env') == 'production')
            <div class="form-label-group">
                {!! NoCaptcha::display() !!}
            </div>
        @endif

        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    </form>
    <a class="mt-1 btn btn-sm btn-light btn-block" href="{{ route('password.request') }}">Forgot your password?</a>
    <a class="mt-4 btn btn-lg btn-secondary btn-block" href="{{ route('register') }}">Haven't got an account?</a>
@endsection

@section('scripts')
    @if (config('app.env') == 'production')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endsection
