<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInformationRequest;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserInformationController extends Controller
{
    //
    private $model;
    private $title;
    private $categories;
    public function __construct()
    {
        $this->model = new User();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        $this->categories = Categories::all();
        View::share('title', $this->title);
        View::share('categories', $this->categories);
    }

    public function edit(Request $request)
    {
        $id = $request->session()->get('id');

        $user = $this->model->find($id);

        return view('clients.users.index', compact('user'));
    }

    public function processUpdateInfor(UserInformationRequest $request, $id) 
    {
        $id = $request->session()->get('id');

        $obj = $this->model->find($id);

        $path = $obj->avatar;
        if ($request->file('user_avatar_img') != null) {
            Storage::disk('public')->delete($path);
            $path = Storage::disk('public')->put('/user_avatar', $request->file('user_avatar_img'));
        }

        $obj->update([
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'password' => $request->get('password'),
            'avatar' => $path,
        ]);

        return redirect()->route('personal-infor');

    }


}
