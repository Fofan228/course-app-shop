<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AuthController extends Controller
    {
        public function showLoginForm()
        {
            return view('auth.login');
        }

        public function login(Request $request)
        {
            $data = $request->validate([
                "email" => ["required", "email", "string"],
                "password" => ["required"]
            ]);

            if (auth("web")->attempt($data)) {
                session()->flash('success', 'Вы успешно вошли в личный кабинет');
                return redirect(route('catalog.index'));
            }

            return redirect(route('auth.login'))->withErrors(["email" => "Ошбика авторизации, пользователь не найден"]);
        }

        public function logout()
        {
            auth("web")->logout();
            session()->flash('success', 'Вы вышли из личного кабинета');

            return redirect(route('catalog.index'));
        }
    }
