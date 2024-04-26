<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use http\Env\Response;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
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

        $cartContent = \Cart::getContent();
        foreach ($cartContent as $cartItem) {
            if ((int) $cartItem->id === (int) $request->id) {
                if (($cartItem->quantity + $request->quantity) > $product->quantity)
                return response()->json(['error' => __('cart.max-quantity')], 422);
            }
        }

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => (int) $product->price,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->thumbnailUrl,
            ],
        ]);

        return response()->json(['data' => __('cart.add-product')]);
    }

    public function removeItem($id)
    {
        \Cart::session($_COOKIE['cart_id'])->remove($id);

        return redirect()->back();
    }

    public function updateQuantity(Request $request)
    {
        \Cart::session($_COOKIE['cart_id']);
        $cartItem = \Cart::get($request->id);
        $product = Product::find($request->id);


        if (($cartItem->quantity + $request->quantity) > $product->quantity) {
            return response()->json(['error' => __('cart.max-quantity')], 422);
        }

        if ($cartItem) {
            \Cart::remove($request->id);
        }

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => (int) $product->price,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->thumbnailUrl,
            ],
        ]);

        return response()->json(['data' => __('cart.change-quantity')]);
    }
}
