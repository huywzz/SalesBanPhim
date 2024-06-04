<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Homepage;
use App\Models\HomepageImages;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomepageController extends Controller
{
    //
    private $model;
    private $title;
    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        View::share('title', $this->title);
    }

    public function index()
    {
        return view('admin.homepage.index');
    }

    public function show(Request $request)
    {
        $listCategories = Categories::orderBy('id', 'asc')->limit(5)->get();
        $categories = Categories::all();
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        $homepageImages = HomepageImages::all();
        $homepageBannerImages = HomepageImages::where('type', 'homepage_banner_img')->limit(3)->get();
        $newProducts = Product::orderBy('created_at', 'desc')->limit(6)->get();
        $topProducts = Product::orderBy('sales_quantity', 'desc')->limit(6)->get();
        return view('clients.root.index', compact('newProducts', 'user', 'categories', 'listCategories', 'homepageImages', 'homepageBannerImages', 'topProducts'));
    }
}
