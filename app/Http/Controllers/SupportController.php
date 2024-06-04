<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class SupportController extends Controller
{
    //

    private $categories;
    private $model;
    private $title;
    public function __construct()
    {
        // $this->model = new Order();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        $this->categories = Categories::all();
        View::share('categories', $this->categories);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        return view('clients.support.index', compact('user'));
    }
}
