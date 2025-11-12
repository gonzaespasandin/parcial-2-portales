<?php

namespace App\Http\Controllers;

use App\Models\Products;

class HomeController extends Controller
{
    public function home()
    {
        $products = Products::all();
        return view('home', ['products' => $products]);
    }
}
