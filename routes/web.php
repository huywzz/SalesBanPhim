<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomepageImagesController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\UsersController;
use App\Models\Categories;
use App\Models\Homepage;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Promotion;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $title = 'Homepage';
//     $categories= Categories::all();
//     return view('clients.root.index',['categories'=>$categories]);
// })->name('root');
Route::get('/', [HomepageController::class, 'show'])->name('root');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');

Route::get('/support', [SupportController::class, 'index'])->name('support');

// Route::get('/personal-information', [UserInformationController::class, 'index'])->name('personal-infor');
Route::get('/personal-information', [UserInformationController::class, 'edit'])->name('personal-infor');
Route::post('/personal-information/{user}', [UserInformationController::class, 'processUpdateInfor'])->name('processUpdateInfor');

Route::get('/categories/{category}', [ProductController::class, 'byCategory'])->name('product.category');
Route::get('/shop', [ProductController::class, 'listProduct'])->name('products.list');
Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/news', [NewsController::class, 'newsClient'])->name('news.newsClient');
Route::get('/news/show/{news}', [NewsController::class, 'show'])->name('news.show');

Route::get('/contact', [ContactController::class, 'contactClient'])->name('contact.contactClient');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/search', [ProductController::class, 'searchByName'])->name('products.autosearch');
Route::get('/filter-price', [ProductController::class, 'filterByPrice'])->name('products.filter-price');

Route::post('/addcart', [CartController::class, 'addCart'])->name('cart.add');
Route::get('/showcart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/deletecart', [CartController::class, 'deleteCart'])->name('cart.delete');
Route::get('/increaseQuantityCart', [CartController::class, 'increaseQuantityCart'])->name('cart.increase');
Route::get('/decreaseQuantityCart', [CartController::class, 'decreaseQuantityCart'])->name('cart.decrease');


Route::get('/formVnpay', [OrderController::class, 'formVnpay'])->name('formVnpay');
Route::post('/paymentvn', [OrderController::class, 'vnpay_payment'])->name('order.vnpay');
Route::get('/proccessvnpay', [OrderController::class, 'proccessVnPay'])->name('order.vnpay.process');




Route::group([
    'middleware' => 'CheckLogin'
], function () {
    Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkoutForm');
    Route::post('/checkout/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/listOrder', [OrderController::class, 'listOrder'])->name('listOrder');
    Route::get('/listOrder/{order}', [OrderController::class, 'orderDetail'])->name('order.detail');

    Route::group(
        [
            'middleware' => 'CheckAdmin'
        ],
        function () {

            // Homepage
            Route::get('admin/homepage', [HomepageController::class, 'index'])->name('homepage.index');

            // Homepage Image
            Route::prefix('admin/homepage/images')->group(function () {
                Route::get('/', [HomepageImagesController::class, 'index'])->name('admin.homepage.images');
                Route::post('/store', [HomepageImagesController::class, 'store'])->name('admin.homepage.images.store');
                Route::delete('/delete/{idImage}', [HomepageImagesController::class, 'destroy'])->name('admin.homepage.images.destroy');
            });

            // Products
            Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
            Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('admin/products/store', [ProductController::class, 'store'])->name('products.store');
            Route::get('admin/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('admin/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('admin/products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

            // Product Image
            Route::prefix('admin/product/images')->group(function () {
                Route::get('/{idProduct}', [ProductImagesController::class, 'index'])->name('admin.product.images');
                Route::post('/store', [ProductImagesController::class, 'store'])->name('admin.product.images.store');
                Route::delete('/delete/{idImage}', [ProductImagesController::class, 'destroy'])->name('admin.product.images.destroy');
            });

            // News
            Route::get('/admin/news', [NewsController::class, 'index'])->name('news.index');
            Route::get('/admin/news/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/admin/news/store', [NewsController::class, 'store'])->name('news.store');
            Route::get('/admin/news/edit/{news}', [NewsController::class, 'edit'])->name('news.edit');
            Route::post('/admin/news/update/{news}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/admin/news/destroy/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

            // Contact
            Route::get('/admin/contact', [ContactController::class, 'index'])->name('contact.index');
            
            Route::delete('/admin/contact/destroy/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

            // Categories
            Route::get('admin/categories', [CategoriesController::class, 'index'])->name('categories.index');
            Route::get('admin/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
            Route::post('admin/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
            Route::get('admin/categories/edit/{categories}', [CategoriesController::class, 'edit'])->name('categories.edit');
            Route::post('admin/categories/update/{categories}', [CategoriesController::class, 'update'])->name('categories.update');
            Route::delete('admin/categories/destroy/{categories}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

            // Promotion
            Route::get('admin/promotion', [PromotionController::class, 'index'])->name('promotion.index');
            Route::get('admin/promotion/create', [PromotionController::class, 'create'])->name('promotion.create');
            Route::post('admin/promotion/store', [PromotionController::class, 'store'])->name('promotion.store');
            Route::get('admin/promotion/edit/{promotion}', [PromotionController::class, 'edit'])->name('promotion.edit');
            Route::post('admin/promotion/update/{promotion}', [PromotionController::class, 'update'])->name('promotion.update');
            Route::delete('admin/promotion/destroy/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy');

            // Manufactures
            Route::get('admin/manufactures', [ManufactureController::class, 'index'])->name('manufactures.index');
            Route::get('admin/manufactures/create', [ManufactureController::class, 'create'])->name('manufactures.create');
            Route::post('admin/manufactures/store', [ManufactureController::class, 'store'])->name('manufactures.store');
            Route::get('admin/manufactures/edit/{manufacture}', [ManufactureController::class, 'edit'])->name('manufactures.edit');
            Route::post('admin/manufactures/update/{manufacture}', [ManufactureController::class, 'update'])->name('manufactures.update');
            Route::delete('admin/manufactures/destroy/{manufacture}', [ManufactureController::class, 'destroy'])->name('manufactures.destroy');

            // Order
            Route::get('admin/orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('admin/orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
            Route::post('admin/orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');
            Route::delete('admin/orders/delete/{order}', [OrderController::class, 'detroy'])->name('orders.destroy');

            // Statistics
            Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
            Route::get('/statistics/filter-by-date', [StatisticsController::class, 'filterByDate'])->name('statistics.filterByDate');

            // Users
            Route::get('admin/users', [UsersController::class, 'index'])->name('users.index');
            Route::get('admin/users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
            Route::post('admin/users/update/{user}', [UsersController::class, 'update'])->name('users.update');

            // getData
            Route::get('admin/getdata', [CategoriesController::class, 'getdata'])->name('categories.getdata');
            Route::get('admin/getdataManu', [ManufactureController::class, 'getdata'])->name('manufactures.getdata');
            Route::get('admin/getdataProduct', [ProductController::class, 'getdata'])->name('products.getdata');

            Route::get('admin/getdata-promotion', [PromotionController::class, 'getdata'])->name('promotion.getdata');

            Route::get('admin/getProductName', [ProductController::class, 'getdataName'])->name('products.getdata.name');
            Route::get('admin/getdataOrder', [OrderController::class, 'getdata'])->name('orders.getdata');
            Route::get('admin/getdataUser', [UsersController::class, 'getdata'])->name('users.getdata');
            Route::get('admin/getnameUser', [UsersController::class, 'getdataName'])->name('users.getdata.name');
            // Route::get('admin/getAlluser',[UserController::class,'index']);
            Route::get('admin/getdataNews', [NewsController::class, 'getdata'])->name('news.getdata');
            Route::get('admin/getNewsName', [NewsController::class, 'getdataName'])->name('news.getdata.name');
            Route::get('admin/getDataContact', [ContactController::class, 'getdata'])->name('contact.getdata');
        }
    );
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
