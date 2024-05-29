<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Flower;
use App\Models\Product;
use App\Models\Subject;
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
		$flowers = Flower::orderBy('name_uk')->get();
		$subjects = Subject::all();
        $products = Product::query();

        if ($request->query('category') && $request->query('category') != 'all') {
            $products->where('category_id', $request->query('category'));
        }

        if ($request->query('subcategory') && $request->query('subcategory') != 'all') {
            $products->where('subcategory_id', $request->query('subcategory'));
        }
        if ($request->has('flowers')) {
            $flowerIds = explode(',', $request->query('flowers'));
            $products->whereHas('flowers', function ($query) use ($flowerIds) {
                $query->whereIn('flower_id', $flowerIds);
            });
        }
		if ($request->has('subject') && $request->subject != 'all') {
			$products->whereHas('subjects', function ($query) use ($request) {
				$query->where('subject_id', $request->query('subject'));
			});
		}
        if ($request->query('min-price') || $request->query('max-price')) {
            $products->whereBetween('price', [$request->query('min-price'), $request->query('max-price')]);
        }

		$currentPage = $request->query('page') ?: 1;
		if ($currentPage) {
			$count = $products->count();
			$countPerPage = 10;
			$countPages = intval(ceil($count / $countPerPage));
			if ($currentPage > 1) {
				$products->skip(($currentPage - 1) * $countPerPage);
			}
			$products->take($countPerPage);
		}

        $products = $products->get();

        if ($request->ajax()) {
			$firstBlock = view('front.pages.catalog.parts.first-products-block', compact('products'))->render();
			$secondBlock = view('front.pages.catalog.parts.second-products-block', compact('products'))->render();
			$paginate = view('components.pagination', compact('currentPage', 'countPages'))->render();
            return response()->json([
				'html' => [
					'first' => $firstBlock,
					'second' => $secondBlock,
					'paginate' => $paginate
				]
			], 200)->header('Content-Type', 'text/html');
        } else {
            return view('front.pages.catalog', compact(
				'products',
				'categories',
				'currentPage',
				'countPages',
				'subjects',
				'flowers'
			));
        }
    }

	public function productShow(Request $request, string $id)
	{
        $product = Product::find($id);
        $randomProducts = Product::orderBy('rating', 'DESC')->limit(5)->get();
        $cartQuantity = isset(\Cart::session(session('cart_id'))->getContent()[$id]) ?
            \Cart::session(session('cart_id'))->getContent()[$id]->quantity : 0;

        $comments = Comment::query()->where('product_id', $id);
        $currentPage = $request->query('page') ?: 1;

        $product->rating =+ 1;
        $product->save();

        if ($currentPage) {
            $count = $comments->count();
            $countPerPage = 3;
            $countPages = intval(ceil($count / $countPerPage));
            if ($currentPage > 1) {
                $comments->skip(($currentPage - 1) * $countPerPage);
            }
            $comments->take($countPerPage);
        }
        $comments = $comments->get();
        if ($request->query('page')) {
            $commentsHtml = view('components.comments', compact(
                'comments',
                'currentPage',
                'countPages'
            ))->render();
            $paginate = view('components.pagination', compact('currentPage', 'countPages'))->render();
            return response()->json([
                'html' => [
                    'comments' => $commentsHtml,
                    'paginate' => $paginate
                ]
            ], 200)->header('Content-Type', 'text/html');
        } else {
            return view('front.pages.product', compact(
                'product',
                'randomProducts',
                'currentPage',
                'countPages',
                'cartQuantity',
                'comments'
            ));
        }
	}

    public function changeFlowerForm(Request $request)
    {
        $params = [];

        $params['page'] = 1;
        $params['category'] = 'all';
        $params['subject'] = $request->input('subject');
        $params['for_whom'] = $request->input('for_whom');
        $params['flower'] = $request->input('flower');
        $params['min-price'] = 0;
        $params['max-price'] = $request->input('max-price');

        $url = route('front.catalog') . '?' . http_build_query($params);

        return redirect($url);
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
}
