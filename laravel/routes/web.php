<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
////Route::get('/demo', function () {
////    return view('home');
////}) -> name('home');
//
//Route::get('/demo', 'App\Http\Controllers\HomeController@index') -> name('home');
//Route::get('/tin-tuc', 'App\Http\Controllers\HomeController@getNews') -> name('news');
//Route::get('/chuyen-muc/{id}', [HomeController::class, 'getCategories']) -> name('news');// laravel 8 khuyến khích sử dụng cách này
////Route::get('/route', function () {
////    $hmtl = '<h1> Demo routes</h1>';
////    return $hmtl;
////});
////Route::get('route-demo', function () {
////    return 'Phương thức get của path/route-demo';
////});
////// Đọc từ trên xuống dưới sẽ render 'Phương thức get của path/route-demo'; xong rồi đến render form
////Route::get('route-demo', function () {
////    return view('form');
//////return 'Phương thức get của path/route-demo';
////});
////
////Route::post('route-demo', function () {
////    return 'Phương thức POST của path/route-demo';
////});
////Route::put('route-demo', function () {
////    return 'Phương thức PUT của path/route-demo';
////});
////Route::delete('route-demo', function () {
////    return 'Phương thức DELETE của path/route-demo';
////});
//
////Route::match(['get', 'post'], '/route-demo', function() {
////    return $_SERVER['REQUEST_METHOD'];
////});
//
////Route::any('route-demo', function(Request $request) {
//////    $request = new Request;
////    return $request->method();
//////    return $_SERVER['REQUEST_METHOD'];
////});
////
////Route::get('show-form', function () {
////    return view('form');
////});
//
////Route::redirect('route-demo', 'show-form', 301);
//
////Route::view('show-form', 'form'); // -> chỉ hỗ trơ GET, HEAD
//
//Route::prefix('admin')->group(function () {
//
////    Route::get('route-demo', function () {
////        return 'Phương thức get của path/route-demo';
////    });
//
////    Route::get('route-demo/{key}-{id}', function ($key, $id) {
////        $content = 'Phương thức get của path/route-demo với tham số:';
////        $content .= 'id = ' . $id;
////        return $content;
////    });
//
//    // demo này thì {key} <-> $id, {id} <-> $key
////    Route::get('route-demo/{key}-{id}', function ($id, $key) {
////        $content = 'Phương thức get của path/route-demo với tham số:';
////        $content .= 'id = ' . $id . '<br>';
////        $content .= ' key = ' . $key;
////        return $content;
////    });
//
//    // ? điều kiện không bắt buộc có thể có hoặc ko
////    Route::get('route-demo/{id?}/{slug?}', function ($id=null, $slug=null) {
////        $content = 'Phương thức get của path/route-demo với tham số:';
////        $content .= 'id = ' . $id . '<br>';
////        $content .= 'slug = ' . $slug . '<br>';
////        return $content;
////    });
//
//    // Cách sử dụng mảng
//    Route::get('route-demo/{key}-{id}.html', function ($key, $id) {
//        $content = 'Phương thức get của path/route-demo với tham số:';
//        $content .= 'id = ' . $id . '<br>';
//        $content .= 'key = ' . $key ;
//        return $content;
//    }) -> where([
//        'key' => '[a-z-]+', // '.+' -> lấy tất cả kí tự
//        'id' => '[0-9]+'
//    ]);
//
//
//    Route::get('route-demo/{key}-{id}.html', function ($key, $id) {
//        $content = 'Phương thức get của path/route-demo với tham số:';
//        $content .= 'id = ' . $id . '<br>';
//        $content .= 'key = ' . $key ;
//        return $content;
//    }) -> where('id', '[\d]+')->where('key', '.+');
//
//    Route::get('route-demo/{id?}/{key?}', function ($id, $key) {
//        $content = 'Phương thức get của path/route-demo với tham số:';
//        $content .= 'id = ' . $id . '<br>';
//        $content .= 'key = ' . $key ;
//        return $content;
//    }) -> where('id', '[\d]+')->where('key', '.+')->name('admin.route-demo');
//
//    Route::get('show-form', function () {
//        return view('form');
//    }) -> name('admin.show-form');
//
//    Route::prefix('product')->middleware('checkpermission')->group(function () {
//        Route::get('/', function () {
//            return 'Danh sách sản phẩm';
//        });
//
//        // Dặt tên cho route và gọi lại ở view home
//        Route::get('/create', function () {
//            return 'Thêm sản phẩm';
//        }) -> name('admin.product.create');
//
//        Route::get('/edit', function () {
//            return 'Chỉnh sửa sản phẩm';
//        });
//
//        Route::get('/delete', function () {
//            return 'Xóa sản phẩm';
//        });
//    });
//});

//Client routes
//Route::get('/', function() {
//   return '<h1 style="text-align: center; color: red">Home Demo</h1>';
//})->name('home');

//Route::get('/', function() {
//    $title = 'Học Laravel View';
//    $content = 'Học Laravel 10.x';
//    $dataView = [
//        'title' => $title,
//        'content' => $content
//    ];
//   return view('home', $dataView);
//})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');


Route::middleware('auth.admin')->prefix('categories')->group(function () {
    //Danh sách chuyên mục
    Route::get('/', [CategoryController::class, 'index'])->name('categories.list');

    //Chi tiết chuyên mục
    Route::get('edit/{id}', [CategoryController::class, 'getCategory'])->name('categories.edit');

    //Xử lý update chuyên mục
    Route::post('edit/{id}', [CategoryController::class, 'updateCategory']);

    //Hiển thị form thêm mới dữ liệu
    Route::get('create', [CategoryController::class, 'createCategory'])->name('categories.create');

    //Xử lý thêm dữ liệu
    Route::post('create', [CategoryController::class, 'handleCreateCategory']);

    //Xóa chuyên mục
    Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('categories.delete');

    //Hiển thị form thêm mới dữ liệu
    Route::get('file', [CategoryController::class, 'createFile'])->name('categories.file');

    //Xử lý thêm dữ liệu
    Route::post('file', [CategoryController::class, 'handleFile']);
});

Route::get('product/{id}', [HomeController::class, 'getProductDetail'])->name('detail');

Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
//    Route::resource('products', ProductsController::class)->middleware('auth.admin.product');
    Route::middleware('auth.admin.product')->resource('products', ProductsController::class);
});

