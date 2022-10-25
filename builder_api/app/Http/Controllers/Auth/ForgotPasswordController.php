<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class ForgotPasswordController extends Controller
{
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

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage(trans($response))
            ->build();
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param Request $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return ResponseBuilder::asError(400)
            ->withHttpCode(Response::HTTP_BAD_REQUEST)
            ->withMessage(trans($response))
            ->build();
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker('users');
    }
}
