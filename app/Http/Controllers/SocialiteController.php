<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

class SocialiteController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser=User::where('social_id',$user->id)->first();
            if($findUser){
                Auth::login($findUser);
                return redirect('/');
            }
            else
            {
                $findUser=User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => Hash::make(Str::random(10)),

                ]);
                Auth::login($findUser);
                return redirect('/');
            }
        }catch (Exception $exception)
        {
            dd($exception->getMessage());
        }
    }
}
