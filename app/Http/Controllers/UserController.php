<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// убрать лишние методы с вызызовами форм, после того, как не пройдена валидация, открыть форму повторно


class UserController extends Controller
{
//    public function create()
//    {
//        return view('user.create');
//    }

    public function store(Request $request)
    {
        session()->forget('logNotConfirmed');
        session()->flash('regNotConfirmed', false);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        session()->forget('regNotConfirmed');

        return redirect()->route('home')->with('success', 'Регистрация успешна');

    }

//    public function loginForm()
//    {
//        return view('user.login');
//    }

    public function login(Request $request)
    {
        session()->forget('regNotConfirmed');
        session()->flash('logNotConfirmed', false);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            session()->forget('logNotConfirmed');

            session()->flash('success', 'Авторизация прошла успешно');

            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.index');
            }
            else {
                return redirect()->route('home');
            }
        }

        return redirect()->back()->with('user-log-alert', 'Неверное имя пользователя или пароль');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }


}
