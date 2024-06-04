<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Categories;
use App\Models\Manufacture;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model;
    private $title;
    private $arrCategories;
    private $arrManufactures;
    private $categories;

    public function __construct()
    {
        $this->model = new Product();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        $this->arrCategories = Categories::all();
        $this->arrManufactures = Manufacture::all();
        $this->categories = Categories::all();
        View::share('title', $this->title);
        View::share('arrCate', $this->arrCategories);
        View::share('arrManu', $this->arrManufactures);
        View::share('categories', $this->categories);
    }
    
    public function listProduct(Request $request)
    {
        $listProduct = Product::all()->toQuery()->paginate(6);
        $countProduct = count(Product::all());
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        $categories = Categories::all();

        return view('clients.products.listProduct', compact('listProduct', 'user', 'categories', 'countProduct'));
    }

    public function index()
    {
        return view('admin.products.index');
    }

    public function getdata()
    {
        return DataTables::of($this->model::query())

            ->editColumn('created_at', function ($object) {
                return $object->getDate();
            })
            ->editColumn('status', function ($object) {
                return $object->getStatus();
            })
            ->editColumn('price', function ($object) {
                return number_format($object->price, 0, '.', ',');
            })
            ->addColumn('name', function ($user) {
                $arr = [];
                $arr['link'] = route('products.show', ['product' => $user]);
                $arr['name'] = $user->name;
                return $arr;
            })
            ->addColumn('edit', function ($user) {
                return route('products.edit', ['product' => $user]);
            })
            ->addColumn('destroy', function ($user) {
                return route('products.destroy', ['product' => $user->id]);
            })
            ->filterColumn('name', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->where('id', $keyword);
                }
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
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $nameManu = Manufacture::find($request->get('manufacture_id'))->name;
        $nameCate = categories::find($request->get('categories_id'))->name;

        $product = $this->model::query()->create(
            [
                'name' => $request->get('name'),
                'specs' => $request->get('specs'),
                'price' => $request->get('price'),
                'status' => 0,
                'quantity' => $request->get('quantity'),
                'manufacture_id' => $request->get('manufacture_id'),
                'manufactures_name' => $nameManu,
                'categories_id' => $request->get('categories_id'),
                'category_name' => $nameCate,
            ]
        );

        foreach ($request->file('product_avatar_img') as $file) {
            $path = Storage::disk('public')->put('/product_avatar', $file);

            DB::table('product_images')->insert(
                [
                    'product_id' => $product['id'],
                    'file_name' => $path,
                    'type' => 'product_avatar_img'
                ]
            );
        }

        foreach ($request->file('product_slider_img') as $file) {
            $path = Storage::disk('public')->put('/product_slider', $file);

            DB::table('product_images')->insert(
                [
                    'product_id' => $product['id'],
                    'file_name' => $path,
                    'type' => 'product_slider_img'
                ]
            );
        }

        foreach ($request->file('product_description_img') as $file) {
            $path = Storage::disk('public')->put('/product_description', $file);

            DB::table('product_images')->insert(
                [
                    'product_id' => $product['id'],
                    'file_name' => $path,
                    'type' => 'product_description_img'
                ]
            );
        }

        return redirect()->route('products.index');
    }

    public function images(Product $product)
    {
        return view('admin.products.image.index', ['product' => $product]);
    }

    public function show(Request $request, Product $product)
    {
        $id_prd = $product->id;
        $product = $this->model->find($id_prd);
        $product->status = $product->getStatus();
        
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        // dd($id);
        // $order = User::find($id)->listOrder->sortByDesc('created_at')->first();
        // $orderDetails = Order::find($order->id)->listOrderDetail->first();
        // $id_product = $orderDetails->product_id;
        // $category_id = product::find($id_product)->categories_id;
        // $productRecommend = categories::find($category_id)->listProduct->take(4);
        $topProducts = Product::orderBy('sales_quantity', 'desc')->limit(6)->get();
        
        return view('clients.products.productDetail', compact('product', 'user', 'topProducts'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', ['product' => $product]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $obj = $this->model->find($product->id);
        $nameManu = Manufacture::find($obj->manufacture_id)->name;
        $nameCate = Categories::find($obj->categories_id)->name;

        $obj->update([
            'name' => $request->get('name'),
            'specs' => $request->get('specs'),
            'price' => $request->get('price'),
            'status' => $request->get('status'),
            'quantity' => $request->get('quantity'),
            'manufacture_id' => $request->get('manufacture_id'),
            'manufactures_name' => $nameManu,
            'categories_id' => $request->get('categories_id'),
            'category_name' => $nameCate,
        ]);

        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {

        $this->model->find($product->id)->delete();

        $arr            = [];
        $arr['status']  = true;
        $arr['message'] = '';

        return response($arr, 200);
    }

    public function filterByPrice(Request $request)
    {
        $price_min = (float)(str_replace(',', '', $request->get('price_min')));
        $price_max = (float)(str_replace(',', '', $request->get('price_max')));
        // $price_min = (float)$request->get('price_min');
        // $price_max = (float)$request->get('price_max');
        // dd($price_min, $price_max);
        // dd(str_replace(',', '', $price_min), str_replace(',', '', $price_max));

        $listProduct = Product::query()->whereBetween('price', [$price_min, $price_max])->paginate(6);

        // $listProduct = Product::all()->toQuery()->;
        $countProduct = count(Product::all());
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        $categories = Categories::all();
        return view('clients.products.listProduct', compact('listProduct', 'user', 'categories', 'countProduct', 'price_min', 'price_max'));
    }

    public function byCategory(Request $request, $category)
    {
        // dd($category);
        $listProduct = Product::query()->where('category_name', $category)->paginate(6);
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        $categories = Categories::all();
        return view('clients.products.listProduct', ['listProduct' => $listProduct, 'categories' => $categories, 'user' => $user]);
    }

    public function searchByName(Request $request)
    {
        $products = Product::query()->where('name', 'LIKE', '%' . $request->name . '%')->get();

        $output = '';
        if (count($products) > 0) {
            $output .= '<ul class="data">';
            foreach ($products as $key) {
                $linkImg = Storage::url($key->ProductImages->where('type', 'product_avatar_img')[1]->file_name);
                $output .= "<a href=" . route('products.show', ['product' => $key->id]) . ">";
                $output .= "<img src=$linkImg>";
                $output .= '<li>' . $key->name . '</li>';
                $output .= '<a/>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="">Not found</li>';
        }
        return $output;
    }
}
