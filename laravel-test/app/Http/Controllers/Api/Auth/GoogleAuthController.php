<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();


            // Handle the user information as needed
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName(),
                    'password' => Hash::make(uniqid()), // Generate a random password
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            // Determine the message based on whether the user was newly created or not
            if ($user->wasRecentlyCreated) {
                // Send the welcome email to the user (only if the user is new)
//                Mail::to($user->email)->send(new WelcomeMail($user));
                $message = 'Registered successfully and welcome email sent';
            } else {
                $message = 'Authenticated successfully';
            }

            // For example, you can create a new user or log in an existing one
            return response()->view('oauth-popup-redirect', [
                'token' => $token,
                'email' => $user->email,
            ]);
        } catch (\Exception $e) {
            //Log the error message
            Log::error('Google authentication error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
