<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
    $products = Product::with('category')->get(); // pastikan relasi category didefinisikan
    return view('dashboard.index', compact('products'));
    }
}
