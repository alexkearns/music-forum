@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h1>{{ config('app.name') }}
            <br />
            <small class="text-muted">Set up your 2 Factor Authentication</small>
        </h1>
    </div>
    <hr/>
        <form action="{{route('register.completeAfter2fa')}}" method="GET">
        <div class="text-center mb-4">
            <h3>Scan QR Code</h3>
        </div>
        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
        <div style="text-align: center;">
            <img src="{{ $qrCode }}">
        </div>
        @if (config('app.env') == 'production')
            <div class="form-label-group">
                {!! NoCaptcha::display() !!}
            </div>
        @endif
        <p>You have not yet been registered, if you do not wish to use 2FA, you can go back to the registration page and start again.</p>
        <div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Complete Registration</button>
        </div>
        </form>

@endsection
@section('scripts')
    @if (config('app.env') == 'production')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endsection