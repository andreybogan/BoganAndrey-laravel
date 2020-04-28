<?php

namespace App\Http\Controllers;

use App\Adaptor\Adaptor;
use App\User;
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

        // Провреяем иникальность email адреса полученного пользователя с уже зарегистрированным пользователем,
        // Если пользователь существует, то перенаправляем на страницу авторизации с соответствуеющим сообщением.
        if (User::query()->where(['email' => $user->accessTokenResponseBody['email']])->where(['type_auth' => 'site'])->first()) {
            return redirect()->route('login');
        }

        // Получаем пользователя по ID социальной сети.
        $userInSystem = $userAdaptor->getUserBySocId($user, 'vk');

        // Регистрируем пользователя в системе.
        Auth::login($userInSystem);

        return redirect()->route('home');
    }
}
