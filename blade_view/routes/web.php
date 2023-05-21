<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Response;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::post('/create', [HomeController::class, 'store'])->name('store');
//Route::put('/create', [HomeController::class, 'putStore']);
Route::get('/products', [HomeController::class, 'products'])->name('product');
Route::get('/demo', function () {
//    return 'Demo response';
    $content = ['name' => 'Laravel 10.x',
        'lesson' => 'Http response'];
    return $content;
});

Route::get('demo-response', function () {
//    $response = new Response('Demo Response', 201);
//    $response = response('Demo Response', 404);
//    $content = '<h2>Demo response</h2>';
//    $content = 'Demo response';
//    $response = response($content)->header('Content-Type', 'text/plain');
//    $content = json_encode([
//        'Item1', 'Item2', 'Item3', 'Item4', 'Item5'
//    ]);
//    $response = (new Response($content))->header('Content-Type', 'text/plain');
//    $response = (new Response($content))->header('Content-Type', 'application/json');
//    $response = (new Response())->cookie('demo', 'demo laravel', 30);
//    dd($response);
//    return $response;
//    dd(response());

//return view('clients.demo-test');

//    $title = 'Demo Laravel';
//    $response = response()
//        ->view('clients.demo-test', compact('title'), 201)
//    ->header('Content-Type', 'application/json')
//    ->header('API-Key', '123456');
//    return $response;

//    $contentArr = ['name' => 'Laravel 10.x',
//        'lesson' => 'Http response'];
//    $response = response()->json($contentArr, 201)->header('API-key', 12345);
//    return $response;
//    echo old('username');
    return view('clients.demo-test');
})->name('demo-response');

Route::post('demo-response', function (Request $request) {
    if (!empty($request->username)) {
//        return 'submit ok';
//        return redirect(route('demo-response'));
//        return redirect()->route('demo-response');
//        return redirect()->route('demo-response');
        return back()->withInput()->with('status','Response');

    }
    return redirect()->route('demo-response')->with('status','No Response');

});

Route::get('demo-response2', function (Request $request) {
    return $request->cookie('demo');
});

Route::get('download-image', [HomeController::class, 'downloadImage'])->name('download-image');

Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add');
    Route::post('/add', [UserController::class, 'postAdd'])->name('post-add');
    Route::get('/edit/{id}', [UserController::class, 'getIdEdit'])->name('edit');
    Route::post('/update', [UserController::class, 'postEdit'])->name('post-edit'); // increase security
    Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('delete');

});

Route::prefix('posts')->name('posts.')->group(function () {
   Route::get('/', [PostController::class, 'index'])->name('index');
   Route::get('/add', [PostController::class, 'add'])->name('add');
   Route::get('/update', [PostController::class, 'update'])->name('update');
   Route::get('/delete', [PostController::class, 'delete'])->name('delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
