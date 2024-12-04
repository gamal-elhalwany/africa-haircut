<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index(){
        $services = Product::with('category')->where('status', 'service')->get();
        $packages = Product::with('category')->where('status', 'packages')->get();
        $groupedServices = $services->groupBy('category.name');
        $groupedPackages = $packages->groupBy('category.name');
        $sliders = Slider::all();
        return view('home', compact('groupedServices', 'groupedPackages', 'services', 'sliders'));
    }
}
