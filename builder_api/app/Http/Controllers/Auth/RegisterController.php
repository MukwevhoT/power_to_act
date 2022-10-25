<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;


class RegisterController extends Controller
{
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

    /**
     * Register a new user [primaryAdmin].
     *
     * @param RegisterRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterRequest $request)
    {
        
        $this->db->beginTransaction();

        // // Create the user
        $user = new $this->user();
        $user->first_name = $request->first_name;
        $user->surname = $request->surname;
        $user->phone_number = $request->phone_number;
        $user->location = $request->location;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // // Send email verification notification TODO

        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('User created successfully')
            ->withData(['user' => $user])
            ->build();
    }
}