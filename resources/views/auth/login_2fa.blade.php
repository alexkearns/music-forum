@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h1>{{ config('app.name') }}
            <br />
            <small class="text-muted">Post messages on the LCR forum.</small>
        </h1>
    </div>
    <hr/>
    <form method="POST" action="{{ route('2fa') }}">
        {{ csrf_field() }}
        <div class="text-center mb-4">
            <h3>Enter the code from your 2FA here</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <small>{{ $error }}</small><br />
                @endforeach
            </div>
        @endif

        <div class="form-label-group">
            <input type="number" id="one_time_password" name="one_time_password" class="form-control" placeholder="2FA Code" value="{{ old('email') }}" required autofocus>
            <label for="one_time_password">2FA Code</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Verify</button>
    </form>
    <form id="logout" action="{{ route('logout') }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-lg btn-danger btn-block" type="submit">Cancel</button>
    </form>
@endsection
