<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\LoginService;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    protected LoginService $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email'    => 'required|string|email',
                'password' => 'required|string|min:8',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                throw new Exception("No user exist with this email", 404);
            }

            $data = $this->loginService->login($user, $request->password);
            return response()->json([
                'message' => 'Login successful',
                'data'    => [
                    'name'  => $data['user']->name,
                    'email' => $data['user']->email,
                    'token' => $data['token'],
                ],
            ], 200);
        } catch (\Throwable $e) {
            // Log the error message
            Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Login failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
