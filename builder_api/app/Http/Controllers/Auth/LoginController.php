<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    private DB $db;
    private User $user;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param User $user
     */
    public function __construct(
        DB $db,
        User $user
    ) {
        $this->db = $db;
        $this->user = $user;
    }

    protected function guard()
    {
        return Auth::guard('api_user');
    }
    
    public function login(LoginRequest $request){
        if (!$jwtToken = $this->attemptLogin($request)) {
            return ResponseBuilder::asError(250)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(trans('auth.failed'))
                ->withData([$this->username() => [trans('auth.failed')]])
                ->build();
        }

        $user = $this->guard()->setToken($jwtToken)->authenticate();


        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage(trans('auth.success_temporary'))
            ->withData(['user' => $user, 'jwtToken' => $jwtToken])
            ->build();
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return string
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()
            ->attempt($this->credentials($request));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('Signed out successfully')
            ->build();
    }
}
