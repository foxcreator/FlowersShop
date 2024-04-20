<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function search(Request $request)
	{
		$keyword = $request->query('keyword');

		$products = Product::where(function($query) use ($keyword) {
			$query->where('title_ua', 'like', "%$keyword%")
				->orWhere('title_ru', 'like', "%$keyword%");
		})->take(5)->get();

		$productsArray = $products->map(function($product) {
			return [
				'url' => route('front.product', $product->id),
				'thumbnailUrl' => $product->thumbnailUrl,
				'title_ua' => $product->title_ua,
				'title_ru' => $product->title_ru,
				// Добавьте другие необходимые поля продукта
			];
		});

		// Возвращаем результаты поиска в формате JSON
		return response()->json($productsArray);
	}
}
