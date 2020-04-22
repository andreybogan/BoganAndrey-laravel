<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Главная страница пользователей.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем всех пользователей.
        $users = User::query()->where('id', '!=', Auth::id())->paginate(5);
        $user = Auth::user();

        return view('admin.user-index', ['users' => $users, 'user' => $user]);
    }

    /**
     * Метод меняет у мпользователя is_admin с true на false и наоборот.
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleAdmin(User $user)
    {
        // Мы не можем лишить прав админа самого себя.
        if ($user->id != Auth::id()) {
            // Меняем значения is_admin на противоположное.
            // Реализовал через if, т.к. в этом случае можно выводить осмысленные сообщения и внедрять дополнительный
            // функционал, например, отправку письма пользователю, что его статус изменен. Если такого функционала
            // не нужно, то можно сделать через  $user->is_admin = !$user->is_admin.
            if ($user->is_admin) {
                $user->is_admin = false;
                $message = 'Пользователь ' . $user->name . ' лишен прав администратора.';
            } else {
                $user->is_admin = true;
                $message = 'Пользователь ' . $user->name . ' наделен правами администратора.';
            }

            // Сохраняем изменения.
            $user->save();

            return redirect()->route('admin.user.index')->with('success', $message);
        }

        return redirect()->route('admin.user.index')->with('error', 'Возникла ошибка при изменении прав');
    }
}
