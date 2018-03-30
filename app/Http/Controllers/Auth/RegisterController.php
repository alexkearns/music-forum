<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as traitRegister;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register function overrides the function defined
     * in the RegistersUsers trait, checks if the user wants
     * to use 2FA and handles
     * @param  Request $request The registration request
     * @return Original register function if no 2FA, view to setup 2FA if not
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //If the user does not want 2FA, send them to the original register function
        if (!$request->has('2fa')) {
            return $this->traitRegister($request);
        }

        $twoFa = app('pragmarx.google2fa');
        $data = $request->all();
        $data["2fa_secret"] = $twoFa->generateSecretKey();
        $request->session()->flash('data', $data);
        $image = $twoFa->getQRCodeInline(
            config('app.name'),
            $data['email'],
            $data['2fa_secret']
        );
        return view('auth.register_2fa', ['qrCode' => $image, 'secret' => $data['2fa_secret']]);
    }

    /**
     * A function to handle registration after the user
     * has setup their 2FA
     * @param  Request $request The request to merge the session data into
     * @return Original register function
     */
    public function finishRegistrationAfter2fa(Request $request)
    {
        $request->merge(session('data'));
        return $this->traitRegister($request);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = User::rulesForCreating();

        // Can only do google recaptcha in production.
        if (config('app.env') == 'production') {
            $rules = array_merge($rules, ['g-recaptcha-response' => 'required|captcha']);
        }

        return Validator::make($data, $rules, User::messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            '2fa_secret' => array_key_exists('2fa_secret', $data) ? $data['2fa_secret'] : null,
        ]);
    }
}
