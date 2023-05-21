<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function __construct(Request $request)
    {
        /*
         * Nếu là trang category hiển thị xin chào Quoc Nhan
         */
//        dd($request);
        if ($request->is('categories')) {
            echo 'Xin chao Quoc Nhan';
        };
    }


    // Hiển thị danh sách chuyên mục - GET
    public function index(Request $request): string
    {
//        if (isset($_GET['id'])) {
//            echo $_GET['id'];
//        }
    //$request->all()
//        $data = $request->all();
//        echo $request->all()['id'] . '<br>';
//        echo $request->all()['name'];
//        dd($data);

        //$request->path();
//        $path = $request->path();
//        echo $path;

        //$request->url();
//        $url = $request->url();
//        echo $url;

        //$request->fullUrl();
//        $fullUrl = $request->fullUrl();
//        echo $fullUrl;

        //$request->method();
//        $method = $request->method();
//        echo $method;
//        if ($request->isMethod('GET')) {
//            echo 'Method GET';
//        }

        //$request->ip();
//        $ip = $request->ip();
//        echo $ip;

        //$request->server();
//        $server = $request->server();
//        dd($server['REQUEST_URI']) ;
//        dd($_SERVER);

        //$request->header();
//        $header = $request->header('user-agent');
//        dd($header) ;

        //$request->input();
//        $input = $request->input();
//        $input = $request->input('id');
//        $input = $request->input('id.4.email');
//        $input = $request->input('id.*.name');
//        $input = $request->input('id.0');
//        $input = $request->input('id')[0];
//        dd($input) ;

        //$request->name;
//        $id = $request->id;
//        $name = $request->name;
//        dd($name);

//        dd(request());
//        dd(request()->id);
//        $id = request('name');
//        dd($id);

        //$request->query();
        $id = $request->query();
//        $id = $request->query('id');
        $query = $request->query();
        dd($query);
        return view('client/category/list');
    }

    // Lấy ra chuyên mục theo id - GET
    public function getCategory($id): string
    {
        return view('client/category/edit');
    }

    //Sửa chuyên mục - POST
    public function updateCategory($id): string
    {
        return 'Submit sửa chuyên mục' . $id;
    }

    //Thêm chuyên mục - POST
    public function createCategory(Request $request): string
    {
//        $path = $request->path();
//
//        echo $path;
//        $old = $request->old('category_name');
//        echo $old;
//        return view('client/category/create', compact('old'));
        return view('client/category/create');
    }

    //Xử lý thêm chuyên mục
    public function handleCreateCategory(Request $request): string
    {
//        if ($request->isMethod('POST')) {
//            return 'Method POST';
//        }
//        $allData = $request->all();
//        dd($allData);
//        return print_r($_POST, true);
//        return redirect(route('categories.create'));
//        return 'Submit thêm chuyên mục';

//        $nameCategory = $request->category_name;
////        $nameCategory = $request->query();
//        dd($nameCategory);

        if ($request->has('category_name')) {
            $nameCategory = $request->category_name;
//            dd($nameCategory);
            $request->flash();
            return redirect(route('categories.create'));
        }else {
            echo 'No category name';
        }

    }

    // Xóa dữ liệu
    public function deleteCategory($id): string
    {
        return 'Submit xóa chuyn mục' . $id;
    }

    public function createFile(Request $request): string
    {
        return view('client/category/file');
    }

    public function handleFile(Request $request) {
//        $upload = $request->file('photo');
        if ($request->hasFile('photo')) {
            if ($request->photo->isValid()) {
                $upload = $request->photo;
//                $path = $upload->path();
                $extension = $upload->extension();
//                $path = $upload->store('image');
//                $path = $upload->store('image', 's3'); // s3 ten dich vu thu 3
//                $path = $upload->storeAs('image', 'demo_file.jpg');
//                dd($path);
//                $fileName = $upload->getClientOriginalName();
                $fileName = md5(uniqid()).'.'.$extension;
                dd($fileName);
            }else {
                echo 'No success';
            }

        }else {
            echo 'Choose file';
        }

    }
}
