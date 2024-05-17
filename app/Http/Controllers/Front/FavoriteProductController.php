<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->favoriteProducts()->get();
        return view('front.pages.favorites.index', compact('products'));
    }
    public function toggleFavorite(Request $request)
    {
        $product = Product::find($request->id);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => __('statuses.not_login')], 422);
        }
        if (!isset($product)) {
            return response()->json(['status' => 'error', 'message' => 'Product not found']);
        }

        if ($user->favoriteProducts()->where('product_id', $product->id)->exists()) {
            $user->favoriteProducts()->detach($product->id);
            return response()->json(['status' => 'delete']);
        } else {
            $user->favoriteProducts()->attach($product->id);
            return response()->json(['status' => 'add']);
        }
    }
}
