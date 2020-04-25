<?php

namespace App\Http\Controllers;

use App\Adaptor\Adaptor;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginVK()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(Adaptor $userAdaptor)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $user = Socialite::driver('vkontakte')->user();
        dd($user);
        $userInSystem = $userAdaptor->getUserBySocId($user, 'vk');

    }
}
