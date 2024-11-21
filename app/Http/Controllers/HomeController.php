<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index($lang){
        App::setLocale($lang);
        $services = Product::with('category')->where('status', 'service')->get();
        $groupedServices = $services->groupBy('category.name');
        return view('home', compact('groupedServices'));
    }
}
