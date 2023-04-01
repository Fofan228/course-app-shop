<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;

    class RegisterController extends Controller
    {
        public function showRegisterForm()
        {
            return view('auth.register');
        }

        public function register(Request $request)
        {
            $data = $request->validate([
                "name" => ["required", "string"],
                "email" => ["required", "email", "string", "unique:users,email"],
                "password" => ["required", "confirmed"]
            ]);

            $user = User::create([
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => bcrypt($data["password"])
            ]);

            if ($user) {
                auth("web")->login($user);
                session()->flash('success', 'Регистрация на сайте прошла успешно');
            }

            return redirect(route('catalog.index'));
        }
    }
