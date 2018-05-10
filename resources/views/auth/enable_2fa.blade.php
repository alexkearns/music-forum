@extends('layouts.auth')

@section('card-content')
    <div class="text-center mb-4">
        <h3>Scan QR Code</h3>
    </div>

    <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
    <div style="text-align: center;">
        <img src="{{ $qrCode }}">
    </div>
    <p>You have not yet been registered, if you do not wish to use 2FA, you can go back to your profile.</p>
    <div>
        <a href="{{route('profile.updateAfter2fa')}}"><button class="btn btn-lg btn-primary btn-block">Continue Setup</button></a>
    </div>
@endsection
