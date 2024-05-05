<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartData = \Cart::session(session('cart_id'))->getContent();
        return view('front.purchase.cart', compact('cartData'));
    }

    public function addToCart(Request $request)
    {
        if (session('cart_id') === null) {
            Session::put('cart_id', uniqid());
        }

        $product = Product::find($request->id);
        $cartId = session('cart_id');

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
        if (\Cart::get($product->id)) {
            return response()->json([
                'data' => __('cart.add-product'),
                'html' => view('front.purchase.parts.order-cart')->render(),
                'productId' => $product->id,
            ]);
        }

        return \response()->json(['error' => 'Smth went wrong'], 422);
    }

    public function removeItem($id)
    {
        \Cart::session(session('cart_id'))->remove($id);
        return redirect()->back();
    }

    public function updateQuantity(Request $request)
    {
        \Cart::session(session('cart_id'));
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
