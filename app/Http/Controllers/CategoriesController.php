<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    private $model;
    private $title;
    public function __construct()
    {
        $this->model = new Categories();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode('-', $arr);
        $this->title = $routeName;
        View::share('title', $this->title);
    }
    public function listCategories()
    {
        $categories = Categories::all();
        return view('clients.layout.topbar', ['categories' => $categories]);
    }

    public function index()
    {
        return view('admin.categories.index');
    }

    public function getdata()
    {
        return Datatables::of($this->model::query())
            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->addColumn('edit', function ($user) {
                return route('categories.edit', ['categories' => $user->id]);
            })
            ->addColumn('destroy', function ($user) {
                return route('categories.destroy', ['categories' => $user->id]);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoriesRequest $request)
    {
        // $path = $request->file('category_img')->store('public/category_imgs');
        $path = Storage::disk('public')->put('/category_imgs', $request->file('category_img'));

        $categories = $this->model::query()->create(
            [
                'name' => $request->get('name'),
                'image' => $path,
            ]
        );
        return redirect()->route('categories.index');
    }


    public function show(Categories $categories)
    {
        //
    }

    public function edit(Categories $categories)
    {
        return view('admin.categories.edit', [
            'categories' => $categories,
        ]);
    }

    public function update(UpdateCategoriesRequest $request, Categories $categories)
    {
        $obj = $this->model->find($categories->id);

        $path = $obj->image;

        if ($request->file('category_img') != null) {
            Storage::disk('public')->delete($path);
            $path = Storage::disk('public')->put('/category_imgs', $request->file('category_img'));
        }

        $obj->update([
            'name' => $request->get('name'),
            'image' => $path,
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy(Categories $categories)
    {
        $this->model->find($categories->id)->delete();

        $arr            = [];
        $arr['status']  = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
