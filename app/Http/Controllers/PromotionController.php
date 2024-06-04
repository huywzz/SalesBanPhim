<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class PromotionController extends Controller
{
    //
    private $model;
    private $title;
    public function __construct()
    {
        $this->model = new Promotion();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        View::share('title', $this->title);
    }

    public function index()
    {
        return view('admin.promotion.index');
    }

    public function getdata()
    {
        return DataTables::of($this->model::query())
            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->editColumn('updated_at', function ($object) {
                return $object->getDate();
            })
            ->editColumn('status', function ($object) {
                return $object->getStatus();
            })
            ->addColumn('edit', function ($promotion) {
                return route('promotion.edit', ['promotion' => $promotion]);
            })
            ->addColumn('destroy', function ($promotion) {
                return route('promotion.destroy', ['promotion' => $promotion->id]);
            })
            ->make(true);
    }

    public function getdataName(Request $request)
    {
        return $this->model
            ->where('title', 'like', '%' . $request->get('a') . '%')
            ->get(
                [
                    'id',
                    'title'
                ]
            );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.create');
    }

    public function store(StorePromotionRequest $request)
    {
        // dd($request->file('news_img'));

        $this->model::query()->create(
            [
                'code' => $request->get('code'),
                'discount' => $request->get('discount'),
                'status' => 0,
            ]
        );

        return redirect()->route('promotion.index');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit', ['promotion' => $promotion]);
    }

    // Update
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $obj = $this->model->find($promotion->id);

        $obj->update([
            'code' => $request->get('code'),
            'status' => $request->get('status'),
            'discount' => $request->get('discount'),
        ]);
        return redirect()->route('promotion.index');
    }

    public function destroy(Promotion $promotion)
    {
        $this->model->find($promotion->id)->delete();

        $arr            = [];
        $arr['status']  = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
