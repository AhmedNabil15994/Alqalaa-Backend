<?php

namespace Modules\Authentication\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Client\LoginRequest;
use Modules\Core\Traits\Response;

class LoginController extends Controller
{
    use Authentication,Response;

    public function __construct()
    {
        $this->guard = 'client';
        $this->login_with = 'user_name';
    }

    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return redirect()->route('frontend.home');
        return view('authentication::client.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $errors = $this->login($request);

        if ($errors)
            return Response()->json([false , 'errors' => $errors],400);

        return Response()->json([true ,__('authentication::client.login.message.login_success') ,'url' => url(route('client.home'))]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->userLogout();
        return redirect()->route('frontend.home');
    }

}
