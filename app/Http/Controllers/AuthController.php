<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function register()
    {
        $categories = Categories::all();
        return view('auth.register', compact('categories'));
    }

    public function processRegister(StoreUserRequest $request)
    {
        try {
            $level = 1;

            $path = Storage::disk('public')->put('/user_avatar', $request->file('user_avatar'));

            $this->model::query()->create(
                [
                    'name' => $request->get('name'),
                    'gender' => $request->get('gender'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'password' => $request->get('password'),
                    'address' => $request->get('address'),
                    'avatar' => $path,
                    'level' => $level,
                ]
            );
            return redirect()->route('root');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('register')->with(['mess' => 'Email đã tồn tại']);
        }
    }

    public function login(Request $request)
    {
        $categories = Categories::all();
        return view('auth.login', compact('categories'));
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->where('password', $request->get('password'))
                ->firstOrFail();

            if (isset($user)) {
                session()->put('id', $user->id);
                session()->put('email', $user->email);
                session()->put('password', $user->password);
                session()->put('level', $user->level);

                return redirect()->route('root');
            }  

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('login')->with(['mess' => 'Sai tài khoản hoặc mật khẩu']);
        }
    }

    public function logout()
    {
        session()->flush();
        $categories = Categories::all();
        return  redirect()->route('login', compact('categories'));
    }
}
