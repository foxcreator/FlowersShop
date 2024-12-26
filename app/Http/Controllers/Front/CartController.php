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

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => (int) $product->price,
            'quantity' => (int) $request->quantity,
            'attributes' => [
                'img' => $product->thumbnailUrl,
                'opt_price' => $product->opt_price
            ],
        ]);

        if (\Cart::get($product->id)) {
            return response()->json([
                'data' => __('cart.add-product'),
                'html' => view('front.purchase.parts.order-cart')->render(),
                'productId' => $product->id,
                'cartCount' => \Cart::getTotalQuantity()
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

    public function delivery($total)
    {
        \Cart::session(session('cart_id'));
        if ($total < 2500) {
            \Cart::add([
                'id' => 0,
                'name' => 'Delivery',
                'price' => (int) 250,
                'quantity' => (int) 1,
                'attributes' => [
                    'img' => 'public/front/images/logo.png',
                ],
            ]);
        } else {
            if (\Cart::get(0) !== null) {
                \Cart::remove(0);
            }
        }
    }
}
