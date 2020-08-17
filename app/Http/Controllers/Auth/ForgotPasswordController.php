<?php

namespace ARsig\Http\Controllers\Auth;

use ARsig\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    // nova validação para verificar se email existe
//    protected function validateEmail(Request $request)
//    {
//        $request->validate(['email' => 'required|email']);
//    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['errors' => ['email' => trans($response)]], 419, [], JSON_UNESCAPED_UNICODE);

//        return back()
//            ->withInput($request->only('email'))
//            ->withErrors(['email' => trans($response)]);
    }
}
