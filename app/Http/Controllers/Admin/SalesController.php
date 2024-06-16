<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Checkbox\CheckboxService;
use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $productsQuery = Product::query();
        if ($request->search) {
            $search = $request->search;
            $productsQuery->where(function ($query) use ($search) {
                $query->where('article', 'LIKE', '%' . $search . '%')
                    ->orWhere('title_uk', 'LIKE', '%' . $search . '%')
                    ->orWhere('title_ru', 'LIKE', '%' . $search . '%');
            });

            $productsQuery->orWhereHas('category', function ($query) use ($search) {
                $query->where('title_ru', 'LIKE', '%' . $search . '%')
                ->orWhere('title_uk', 'LIKE', '%' . $search . '%');
            });
        }
        $products = $productsQuery->orderBy('quantity', 'desc')->orderBy('article')->paginate(9);
        return view('admin.sales.index', compact('products', 'cart'));
    }
}
