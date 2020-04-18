<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $user->is_admin = !$user->is_admin;

            // Сохраняем изменения.
            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'Права изменены');
        }

        return redirect()->route('admin.user.index')->with('error', 'Возникла ошибка при изменении прав');
    }
}
