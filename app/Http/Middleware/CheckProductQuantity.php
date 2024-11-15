<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CheckProductQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve products with low stock
        $lowStockProducts = Product::where('quantity', '<=', 50)->get();

        // Pass the alert data to views if low-stock products exist
        if ($lowStockProducts->isNotEmpty()) {
            View::share('lowStockAlert', true);
            View::share('lowStockProducts', $lowStockProducts);
        }
        return $next($request);
    }
}
