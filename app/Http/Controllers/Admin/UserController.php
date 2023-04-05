<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;

    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $users = User::paginate(5);
            return view('admin.user.index', compact('users'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(User $user)
        {
            $roles = User::ROLES;
            return view('admin.user.edit', compact('user', 'roles'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, User $user)
        {
            $this->validator($request->all(), $user->id)->validate();

            if ($request->change_password) {
                $request->merge(['password' => Hash::make($request->password)]);
                $user->update($request->all());
            } else {
                $user->update($request->except(['_token', '_method', 'password']));
            }
            session()->flash('Данные пользователя успешно обновлены');
            return redirect(route('admin.user.index'));
        }

        private function validator(array $data, int $id)
        {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email,' . $id . ',id',
                ],
            ];
            if (isset($data['change_password'])) {
                $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            }
            return Validator::make($data, $rules);
        }
    }
