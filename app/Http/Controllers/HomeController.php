<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $services = Product::where('status', 'service')->take(4);
        return view('home', compact('services'));
    }
}
