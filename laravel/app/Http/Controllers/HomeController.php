<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    public function index(): string
    {
//        return 'Home';
        $title = 'Học Laravel View';
        $content = 'Học Laravel 10.x';
//        $dataView = [
//            'title' => $title,
//            'content' => $content
//        ];
//        return view('home', $dataView); // C1

        return view('home', compact('title', 'content')); // C2

//        return view('home')->with(['title' => $title, 'content' => $content]); // C3

//        return View::make('home', compact('title', 'content'));

//        return View::make('home')->with(['title' => $title, 'content' => $content]);

//        $contentView = view('home')->render();
////        $contentView = $contentView->render();
//        dd($contentView);
////        echo $contentView;
////        return $contentView;
    }


    public function getNews(): string
    {
        return 'Danh sách tin tức';
    }

    public function getCategories($id): string
    {
        return 'Chuyên mục:' . $id;
    }

    //
    public function getProductDetail($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        return view('client/product/detail', compact('id'));
        return view('client.product.detail', compact('id'));// nên dùng dấu '.'
    }
}
