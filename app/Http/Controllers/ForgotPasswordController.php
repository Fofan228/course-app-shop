<?php

    namespace App\Http\Controllers;

    use App\Mail\ForgotPassword;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class ForgotPasswordController extends Controller
    {
        public function showForgotPasswordForm()
        {
            return view('auth.forgot');
        }

        public function forgotPassword(Request $request)
        {
            $data = $request->validate([
                "email" => ["required", "email", "string", "exists:users"]
            ]);

            $user = User::where(["email" => $data["email"]])->first();

            $password = uniqid();

            $user->password = bcrypt($password);
            $user->save();

            Mail::to($user)->send(new ForgotPassword($password));

            return redirect(route('complete_forgot_password'));
        }

        public function showCompleteForgotPassword()
        {
            return view('auth.completeForgot');
        }
    }
