<?php

namespace ARsig\Http\Controllers\Auth;

use ARsig\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

//    protected function guard()
//    {
//        return Auth::guard('web');
//    }

    protected function resetPassword($user, $password)
    {
        $user->password_md5 = md5($password);
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {

        return response()->json(['errors' => ['email' => trans($response)]], 419, [], JSON_UNESCAPED_UNICODE);
//        return redirect()->back()
//            ->withInput($request->only('email'))
//            ->withErrors(['email' => trans($response)]);
    }


}
