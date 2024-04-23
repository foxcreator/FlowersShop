<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
//        \Cart::session($_COOKIE['cart_id'])->clear();
        $cartData = \Cart::session($_COOKIE['cart_id'])->getContent();
        return view('front.purchase.cart', compact('cartData'));
    }

    public function addToCart(Request $request)
    {

        if (!isset($_COOKIE['cart_id'])) {
            setcookie('cart_id', uniqid());
        }

        $product = Product::find($request->id);
        $cartId = $_COOKIE['cart_id'];

        \Cart::session($cartId);
        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => (int) $product->price,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->thumbnailUrl,
            ],
        ]);

        return response()->status();
    }
}
