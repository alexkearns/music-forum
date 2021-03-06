@extends('layouts.auth')

@section('card-content')
    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="text-center mb-4">
            <h3>Register</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <small>{{ $error }}</small><br />
                @endforeach
            </div>
        @endif

        <div class="form-label-group">
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}"
                   required autofocus>
            <label for="name">Name</label>
        </div>

        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address"
                   value="{{ old('email') }}" required>
            <label for="email">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        @if (config('app.env') == 'production')
            <div class="form-label-group">
                {!! NoCaptcha::display() !!}
            </div>
        @endif

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>
@endsection

@section('scripts')
    @if (config('app.env') == 'production')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endsection
