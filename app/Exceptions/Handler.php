<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Modules\Core\Traits\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use Response;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = Arr::get($exception->guards(), 0);

        if ($request->expectsJson()) {
            return $this->error('UNAUTHENTICATED');
        }

        switch ($guard) {
            case 'web':
                $login = 'dashboard.login';
                break;
            case 'client':
                $login = 'client.login';
                break;
            default:
                $login = 'dashboard.login';
                break;
        }
        return redirect(route($login));
    }
}
