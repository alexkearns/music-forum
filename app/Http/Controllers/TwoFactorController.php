<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    /**
     * Show the 2fa setup page.
     */
    public function enable2fa(Request $request)
    {
        $twoFa = app('pragmarx.google2fa');
        $data = \Auth::user()->toArray();
        $data["2fa_secret"] = $twoFa->generateSecretKey();
        $request->session()->flash('data', $data);
        $image = $twoFa->getQRCodeInline(
            config('app.name'),
            $data['email'],
            $data['2fa_secret']
        );

        return view('auth.enable_2fa', ['qrCode' => $image, 'secret' => $data['2fa_secret']]);
    }

    /**
     * Disable a users 2fa by deleting their secret in the db.
     */
    public function disable2fa()
    {
        $user = \Auth::user();
        $user->{'2fa_secret'} = null;
        $user->save();
        Google2FA::logout();

        return redirect()->route('profile', ['profile' => \Auth::user()->id]);
    }

    /**
     * Set up a users 2fa by setting the 2fa_secret in the db.
     */
    public function complete2fa(Request $request)
    {
        $request->merge(session('data'));
        $user = \Auth::user();
        $user->{'2fa_secret'} = $request->{'2fa_secret'};
        $user->save();

        return redirect()->route('profile', ['profile' => \Auth::user()->id]);
    }
}
