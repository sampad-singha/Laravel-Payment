<?php

namespace App\Services\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     * Create a new class instance.
     * @throws Exception
     */
    public function login(User $user, string $password): array
    {
        // Check if the password is correct
        if (!Hash::check($password, $user->password)) {
            throw new Exception("Incorrect password", 401);
        }

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
