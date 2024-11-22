<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $services = Product::with('category')->where('status', 'service')->get();
        $packages = Product::with('category')->where('status', 'packages')->get();
        $groupedServices = $services->groupBy('category.name');
        $groupedPackages = $packages->groupBy('category.name');
        return view('home', compact('groupedServices', 'groupedPackages', 'services'));
    }
}
