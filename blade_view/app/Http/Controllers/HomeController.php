<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public array $data = [];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $this->data['welcome'] = '<b>Welcome</b> demo view';
//        $this->data['index'] = 1;
//        $this->data['contents'] = '<h3>Demo view</h3>
//<p>1</p>
//<p>2</p>
//<p>3</p>
//<p>4</p>';
//        $this->data['dataArr'] = [
//                'Item 1',
//                'Item 2',
//                'Item 3',
//                'Item 4',
//                'Item 5',
//        ];
//        $this->data['dataArr'] = [
//        ];

//        $this->data['number'] = 10;

        $this->data['message'] = 'Demo include';
        $this->data['title'] = 'Demo view master layout';
//        $users = DB::select('select * from users where');
//        $users = DB::select('select * from users where id > ?', [1]);
        $users = DB::select('select * from users where email = :email', [
            'email' => 'nhan@gmail.com'
        ]);
        //
        return view('clients.home', $this->data);
    }

    public function products()
    {
        $this->data['title'] = 'Product page';
        return view('clients.product', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['title'] = 'Add product page';
        $this->data['errorMessage'] = 'Please check data';
        //
        return view('clients.add', $this->data);
    }

    public function isUppercase($value, $message, $fail)
    {
        if ($value !== strtoupper($value)) {
            $fail($message);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(ProductRequest $request)
//    public function store(Request $request)
    {
        $inputs = $request->all();
//        $rules = [
////            'name_product' => 'required|min:6',
////            'name_product' => ['required','min:6', new Uppercase()],
//            'name_product' => ['required', 'min:6',
//                function ($attribute, $value, $fail) {
//                    $message = ':attribute must be uppercase.';
////                    $this->isUppercase($value, $message, $fail);
//                    isUppercase($value, $message, $fail);
//                }
//            ],
//            'price_product' => 'required|integer'
//        ];

        $rules = [
//            'name_product' => 'required|min:6',
//            'name_product' => ['required','min:6', new Uppercase()],
            'name_product' => ['required', 'min:6'],
            'price_product' => 'required|integer'
        ];

//        $messages = [
//            'name_product.required' => 'Name product is required',
//            'name_product.min' => 'Name product bigger than :min characters',
//            'price_product.required' => 'Price product is required',
//            'price_product.integer' => 'Price product is number',
//        ];

        $messages = [
            'required' => ':attribute is required',
            'min' => ':attribute bigger than :min characters',
            'integer' => ':attribute is number',
            'uppercase' => ':attribute must uppercase',
        ];

        $attributes = [
            'name_product' => 'Name product',
            'price_product' => 'Price product',
        ];

//        dd($request->all());
//        $validator = Validator::make($inputs, $rules, $messages, $attributes);
//        $validator->validate();

//        $request->validate($rules, $messages);

//        return response()->json(['status'=>'success']);
//        if ($validator->fails()) {
//            $validator->errors()->add('msg', 'Please check data');
////            return 'Validate fails';
//        } else {
//            return redirect()->route('product')->with('msg', 'Add data success');
////            return 'Validate success';
//        }
//
//        return back()->withErrors($validator);

//        $rules = [
//            'name_product' => 'required|min:6',
//            'price_product' => 'required|integer'
////                'price_product' => ['required','integer']
//        ];
////        $messages = [
////            'name_product.required' => 'Name product is required',
////            'name_product.required' => ':attribute is required',
////            'name_product.min' => 'Name product bigger than :min characters',
////            'price_product.required' => 'Price product is required',
////            'price_product.integer' => 'Price product is number',
////        ];
//
//        $messages = [
//            'required' => 'Field :attribute is required',
//            'min' => 'Field :attribute bigger than :min characters',
//            'integer' => 'Field :attribute is number'
//        ];
//        $request->validate($rules, $messages);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function putStore(Request $request)
    {
        dd($request);
    }

    public function getArr()
    {
        $content = ['name' => 'Laravel 10.x',
            'lesson' => 'Http response'];
        return $content;
    }

    public function downloadImage(Request $request)
    {
        if (!empty($request->image)) {
            $image = trim($request->image);
            $fileName = 'image_' . uniqid() . '.jpg';
            return response()->streamDownload(function () use ($image) {
                $imageContent = file_get_contents($image);
                echo $imageContent;
            }, $fileName);
        }
    }
}
