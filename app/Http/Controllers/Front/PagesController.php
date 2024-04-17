<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('front.pages.homepage');
    }

    public function catalog(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();
        if ($request->query('category') && $request->query('category') != 'all') {
            $products->where('category_id', $request->query('category'));
        }
        if ($request->query('min-price') || $request->query('max-price')) {
            $products->whereBetween('price', [$request->query('min-price'), $request->query('max-price')]);
        }
        $products = $products->get();

//        dd($request->query('category'));
        if ($request->query('category') || $request->query('category') == 'all') {
            return response()->json($products);
        } else {
            return view('front.pages.catalog', compact('products', 'categories'));
        }
    }

    public function delivery()
    {
        return view('front.pages.delivery');
    }

    public function about()
    {
        return view('front.pages.about');
    }

    public function contacts()
    {
        return view('front.pages.contacts');
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->input('category');

        // Выберите товары по выбранной категории
        $products = Product::where('category_id', $categoryId)->get();

        return response()->json($products);
    }
}
