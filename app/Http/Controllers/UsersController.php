<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
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

    public function index()
    {
        return view('admin.users.index');
    }

    public function getdata()
    {
        return DataTables::of($this->model::query())

            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->addColumn('edit', function ($user) {
                return route('users.edit', ['user' => $user]);
            })
            ->make(true);
    }

    public function getdataName(Request $request)
    {
        return $this->model
            ->where('name', 'like', '%' . $request->get('a') . '%')
            ->get(
                [
                    'id',
                    'name'
                ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $obj = $this->model->find($user->id);
        $obj->update([
            'level' => $request->get('level'),
        ]);
        return redirect()->route('users.index');
    }
}
