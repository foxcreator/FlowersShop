<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Http\Services\Checkbox\CheckboxService;
use App\Models\Product;
use Illuminate\Http\Request;
use function redirect;
use function session;
use function view;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->cartService->getTotal();

        return view('admin.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $this->cartService->addProductToCart($product, $request->quantity);

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $email = $request->email ? $request->email : env('DEFAULT_EMAIL');

        if ($order = $this->cartService->checkoutProductToDb($request->payment_method, $email)) {
            return redirect()->route('sales.index')->with('status', "Чек #$order->id закрыт");
        }

        return redirect()->back()->with('error', "Чек #$order->id закрыт");
    }

    public function remove(Product $product)
    {
        $product->removeFromCart();
        return redirect()->back()->with('status', "$product->title_uk удален из чека");
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('sales.index')->with('status', 'Корзина успешно очищена');
    }


    public function check()
    {
        $cart = session()->get('cart', []);
        $total = $this->cartService->getTotal();
        return view('checkout', compact('total', 'cart'));
    }

    public function closeShift()
    {
        $checkboxService = new CheckboxService();
        $checkboxService->setUser(auth()->user());
        $checkboxService->signInCashier();
        if ($checkboxService->getCashierShift()) {
            $checkboxService->closeShift();
            return redirect()->back()->with(['status' => 'Смена успешно закрыта']);
        }

        return redirect()->back()->with(['error' => 'Смена еще не отрыта! Начните продажи для открытия смены']);
    }
}

