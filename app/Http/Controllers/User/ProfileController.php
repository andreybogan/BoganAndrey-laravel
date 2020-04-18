<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $errors = [];

        if ($request->isMethod('post')) {
            if ($request->post('new_password')) {
                // Проверяем сопадает введенный текущий пароль с сохраненным паролем.
                if (!Hash::check($request->post('password'), $user->password)) {
                    $errors['password'] = 'Неверно указан текущий пароль';
                }

                // Выполняем проверку на совпадение нового пароля с его повтором.
                if ($request->post('new_password') != $request->post('password_confirmation')) {
                    $errors['new_password'] = 'Пароли не совпадают';
                }

                if (!$errors) {
                    // Обновляем данные
                    $user->fill([
                        'name' => $request->post('name'),
                        'email' => $request->post('email'),
                        'password' => Hash::make($request->post('new_password')),
                    ]);

                    $user->save();

                    $request->session()->flash('success', 'Данные пользователя успешно изменены!');
                }

                return redirect()->route('user.updateProfile')->withErrors($errors);
            }

        }

        return view('user.update-profile', ['user' => $user]);
    }
}
