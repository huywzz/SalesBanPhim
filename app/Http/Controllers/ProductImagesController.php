<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductImagesController extends Controller
{
    //
    public function index($idProduct)
    {
        $productName = Product::find($idProduct)->name;

        $product = Product::find($idProduct);

        $productAvatars = ProductImages::where([
            ['type', '=', 'product_avatar_img'],
            ['product_id', '=', $idProduct]
        ])->get();

        $productSliders = ProductImages::where([
            ['type', '=', 'product_slider_img'],
            ['product_id', '=', $idProduct]
        ])->get();

        $productDescriptions = ProductImages::where([
            ['type', '=', 'product_description_img'],
            ['product_id', '=', $idProduct]
        ])->get();

        $title = 'Image';

        return view('admin.products.image.index', compact('productAvatars', 'productSliders', 'productDescriptions', 'title', 'productName', 'product'));
    }

    public function store(Request $request)
    {

        $path = '';
        
        if ($request->type == "product_avatar_img") {
            foreach ($request->file('product_avatar_img') as $file) {
                $path = Storage::disk('public')->put('/product_avatar', $file);
                ProductImages::insert([
                    'product_id' => $request->product_id,
                    'file_name' => $path,
                    'type' => $request->type
                ]);
            }
        }
        if ($request->type == "product_slider_img") {
            foreach ($request->file('product_slider_img') as $file) {
                $path = Storage::disk('public')->put('/product_slider', $file);
                ProductImages::insert([
                    'product_id' => $request->product_id,
                    'file_name' => $path,
                    'type' => $request->type
                ]);
            }
        }
        if ($request->type == "product_description_img") {
            foreach ($request->file('product_description_img') as $file) {
                $path = Storage::disk('public')->put('/product_description', $file);
                ProductImages::insert([
                    'product_id' => $request->product_id,
                    'file_name' => $path,
                    'type' => $request->type
                ]);
            }
        }

        // ProductImages::insert([
        //     'product_id' => $request->product_id,
        //     'file_name' => $path,
        //     'type' => $request->type
        // ]);

        return back();
    }

    public function destroy($idImage)
    {
        $productImage = ProductImages::find($idImage);

        $file_name = $productImage->file_name;

        if (!$file_name)
            unlink($file_name);
        $productImage->delete();

        return back();
    }
}
