<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class AdminController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');
        }

        public function index()
        {
            return view('admin.index');
        }

        protected function authenticated(Request $request, $user)
        {
            $route = 'user.index';
            $message = 'Вы успешно вошли в личный кабинет';
            if ($user->admin) {
                $route = 'admin.index';
                $message = 'Вы успешно вошли в панель управления';
            }
            session()->flash('success', $message);
            return redirect(route($route));
        }
    }
