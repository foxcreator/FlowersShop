<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('quantity', 'desc')->orderBy('article')->paginate(9);
        return view('admin.sales.index', compact('products'));
    }
}
