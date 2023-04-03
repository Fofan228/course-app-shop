<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class UserAvatarController extends Controller
    {
        public function update(Request $request)
        {
            // будет сохранен как storage/app/avatars/L6ceL...xzXFw.jpeg
//            $path = $request->file('avatar')->store('avatars');
            $path = $request->file('avatar')->storeAs(
                'avatars', // директория, куда сохранять
                $request->user()->id, // имя файла
                'public' // диск, куда сохранять
            );
            return $path;
        }
    }
