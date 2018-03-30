@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h1>{{ config('app.name') }}
            <br />
            <small class="text-muted">Set up your 2 Factor Authentication</small>
        </h1>
    </div>
    <hr/>
        <div class="text-center mb-4">
            <h3>Scan QR Code</h1>
        </div>
        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
        <div style="text-align: center;">
            <img src="{{ $qrCode }}">
        </div>
        <p>You have not yet been registered, if you do not wish to use 2FA, you can go back to the registration page and start again.</p>
        <div>
            <a href="{{route('register.completeAfter2fa')}}"><button class="btn btn-lg btn-primary btn-block">Complete Registration</button></a>
        </div>

@endsection