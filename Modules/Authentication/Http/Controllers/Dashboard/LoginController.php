<?php

namespace Modules\Authentication\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Dashboard\LoginRequest;

class LoginController extends Controller
{
    use Authentication;

    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return redirect()->route('frontend.home');
        return view('authentication::dashboard.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $errors =  $this->login($request);

        if ($errors)
            return Response()->json([false , 'errors' => $errors],400);

        return Response()->json([true ,__('authentication::client.login.message.login_success') ,'url' => url(route('dashboard.home'))]);
    }


    /**
     * Logout method
     */
    public function logout(Request $request)
    {
        $this->userLogout();
        return redirect()->route('frontend.home');
    }

}
