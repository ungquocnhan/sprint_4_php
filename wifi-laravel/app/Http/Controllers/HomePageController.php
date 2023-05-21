<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index() {
        $title = 'Trang chủ';
        return view('clients.home-page', compact('title'));
    }
}
