<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class CartController extends Controller
{
    private $categories;
    public function __construct()
    {
        $this->categories = categories::all();
        View::share('categories', $this->categories);
    }

    public function addCart(Request $request)
    {
        // session()->forget('cart');
        $id = $request->get('product_id');
        $product = Product::find($id);
        $product_img = $product->ProductImages->where('type', 'product_avatar_img')[1]->file_name;
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'product_image' => $product_img,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }
        session()->put('cart', $cart);

        return view('clients.cart.cartHeader');
    }

    public function showCart(Request $request)
    {
        $total = $this->totalCart();
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        return view('clients.cart.cartDetail', compact('total', 'user'));
    }

    public function deleteCart(Request $request)
    {
        $id = $request->get('id');
        $total = 0;
        if (session()->get('cart') != null) {
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $total = $this->totalCart();
        $arr = [];
        $arr['id'] = $id;
        $arr['total'] = $total;
        return $arr;
    }

    public function increaseQuantityCart(Request $request)
    {
        $id = $request->get('id');
        $total = 0;
        if (session()->get('cart') != null) {
            $cart = session()->get('cart');
            $cart[$id]['quantity'] =  $cart[$id]['quantity'] + 1;
            session()->put('cart', $cart);
        }
        $total = $this->totalCart();
        $arr = [];
        $arr['id'] = $id;
        $arr['quantity'] = $cart[$id]['quantity'];
        $arr['totalDetail'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        $arr['total'] = $total;
        return $arr;
    }

    public function decreaseQuantityCart(Request $request)
    {
        $id = $request->get('id');
        $total = 0;
        if (session()->get('cart') != null) {
            $cart = session()->get('cart');
            $cart[$id]['quantity'] =  $cart[$id]['quantity'] - 1;
            session()->put('cart', $cart);
        }

        $total = $this->totalCart();
        $arr = [];
        $arr['id'] = $id;
        $arr['quantity'] = $cart[$id]['quantity'];
        $arr['totalDetail'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        $arr['total'] = $total;
        return $arr;
    }

    // 
    public function totalCart()
    {
        $total = 0;
        if (session()->get('cart') != null) {
            foreach (session()->get('cart') as $key) {
                $total = $key['price'] * $key['quantity'] + $total;
            }
        }
        return $total;
    }
}
