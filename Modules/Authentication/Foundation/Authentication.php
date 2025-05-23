<?php

namespace Modules\Authentication\Foundation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Modules\DeviceToken\Traits\SessionDeviceHandler;

trait Authentication
{
    use SessionDeviceHandler;

    protected $guard = 'web';
    protected $login_with = 'email';

    protected function getGuard()
    {
        return $this->guard;
    }

    public static function authentication($credentials , $guard,$loginWith)
    {
        // LOGIN BY : Mobile & Password
        if($loginWith == 'email'){
            if (is_numeric($credentials->email)):

                $auth = Auth::guard($guard)->attempt([
                    'mobile' => $credentials->email,
                    'password' => $credentials->password
                ], $credentials->has('remember')
                );

            // LOGIN BY : Email & Password
            elseif (filter_var($credentials->email, FILTER_VALIDATE_EMAIL)):

                $auth = Auth::guard($guard)->attempt([
                    'email' => $credentials->email,
                    'password' => $credentials->password
                ],
                    $credentials->has('remember')
                );

            endif;
        }else{
            $auth = auth($guard)->attempt([
                $loginWith => $credentials->$loginWith,
                'password' => $credentials->password
            ],
                $credentials->has('remember')
            );
        }

        return $auth;
    }

    public function login($credentials)
    {
        try {

            if (self::authentication($credentials,$this->getGuard(),$this->login_with)){

                if(auth($this->getGuard())->user()->status == 0){
                    auth($this->getGuard())->logout();
                    $errors = new MessageBag([
                        'password' => __('authentication::dashboard.login.validations.blocked')
                    ]);
                    return $errors;
                }else{

                    if($this->checkGuardIsSession())
                        $this->createToken();

                    return false;
                }
            }else{

                $errors = new MessageBag([
                    'password' => __('authentication::dashboard.login.validations.failed')
                ]);
            }

            return $errors;

        } catch (Exception $e) {

            return $e;

        }
    }

    public function loginAfterRegister($credentials)
    {
        try {

            self::authentication($credentials,$this->getGuard(),$this->login_with);

        } catch (Exception $e) {

            return $e;

        }
    }
}
