<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function homeView(){
        $services = Product::where('status','service')->latest()->take(4)->get();
        return view('home',compact('services'));
    }
}
