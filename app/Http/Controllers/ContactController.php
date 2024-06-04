<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Categories;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model;

    public function __construct()
    {
        $this->model = new Contact();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        View::share('title', $this->title);
    }

    public function index()
    {
        return view('admin.contact.index');
    }

    public function getdata()
    {
        return DataTables::of($this->model::query())
            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->addColumn('destroy', function ($user) {
                return route('contact.destroy', ['contact' => $user->id]);
            })
            ->make(true);
    }

    public function contactClient(Request $request) {
        $categories = Categories::all();
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        return view('clients.contact.contact', compact('categories', 'user'));
    }

    public function store(StoreContactRequest $request)
    {
        $this->model::query()->create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'content' => $request->get('content'),
            ]
        );

        return back();
    }

    public function destroy(Contact $contact)
    {
        $this->model->find($contact->id)->delete();

        $arr = [];
        $arr['message'] = '';

        return response($arr, 200);
    }
}
