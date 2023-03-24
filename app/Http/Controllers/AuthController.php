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
                return redirect(route("home"));
            }

            return redirect(route("login"))->withErrors(["email" => "Ошбика авторизации, пользователь не найден"]);
        }

        public function logout()
        {
            auth("web")->logout();

            return redirect(route("home"));
        }
    }
