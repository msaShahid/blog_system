<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            
            $existingUser = User::where('email', $user->email)->first();
    
            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->intended(route('user.dashboard'));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('password123'), 
                    'provider_name' => $provider,
                    'provider_id' => $user->id,
                    'provider_token' => $user->token,
                    'email_verified_at' => now(),
                ]);
    
                Auth::login($newUser);
    
                return redirect()->intended(route('user.dashboard'));
            }
    
        } catch (Exception $e) {
            Log::error('Socialite login error: ' . $e->getMessage());

            return redirect()->route('login')->with('error', 'Unable to login with Socialite. Please try again.');       
        }
    }

}
