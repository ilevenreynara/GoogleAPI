<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
// API Scopes
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Classroom;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
        ->scopes(
        [
            'openid', 'profile', 'email', 
            Google_Service_Calendar::CALENDAR, Google_Service_Calendar::CALENDAR_EVENTS,
            Google_Service_Classroom::CLASSROOM_COURSES, Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS,
            Google_Service_Classroom::CLASSROOM_ANNOUNCEMENTS
        ]
        )
        ->with(["access_type" => "offline", "prompt" => "consent select_account"])
        ->redirect();
    }
    
    public function handleGoogleCallback()
    {
        session_start();
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();
       
            if ($finduser) {
                $_SESSION['access_token'] = $user->token;
                // $_SESSION['refresh_token'] = $user->refreshToken;
                // $_SESSION['expires_in'] = $user->expiresIn;
       
                Auth::login($finduser);
                return redirect()->intended('dashboard');
       
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('ukm12345*')
                ]);
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}