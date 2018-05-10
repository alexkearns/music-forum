<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Mail;
use App\Mail\UserInvite;
use App\Invite;
use App\User;

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
     * Create an invite for the user. They then need to click the email
     * link to complete registration.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $token = str_random();
        $invite = Invite::create([
            'token' => $token,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Mail::to($request->email)
            ->send(new UserInvite($invite));

        flash('Invite sent')->success();
        return back();
    }

    /**
     * Find the correct token, register the user, and log them in.
     */
    public function completeRegister($token)
    {
        $invite = Invite::where('token', $token)->first();
        $invite->delete();

        $user = User::create([
            'name' => $invite->name,
            'email' => $invite->email,
            'password' => $invite->password
        ]);

        Auth::login($user);

        return redirect()->route('home');
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
            'password' => bcrypt($data['password'])
        ]);
    }
}
