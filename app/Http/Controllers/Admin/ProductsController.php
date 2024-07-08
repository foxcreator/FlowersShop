<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SearchHelper;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileStorageService;
use App\Http\Services\ImagesService;
use App\Models\Category;
use App\Models\Flower;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filter === 'out_in_stock') {
            $query->where('quantity', 0);
        }

        if ($request->sort) {
            list($sortField, $sortOrder) = explode(':', $request->sort);
            $query->orderBy($sortField, $sortOrder);
        }

        if ($request->search) {
            $products = SearchHelper::search(
                Product::class,
                ['title_ru', 'title_uk', 'article'],
                $request->search,
                isset($sortField) ? [$sortField => $sortOrder] : [],
                30
            );
        } else {
            $products = $query->paginate(30);
        }

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $countNoveltyProduct = Product::query()->where('is_novelty', true)->count();
        $categories = Category::all();
        $flowers = Flower::all();
        $subjects = Subject::all();
        $article = $this->getArticle();
        $products = Product::products()->where('quantity', '>', 0)->get();
        return view('admin.products.create', compact(
			'categories',
			'article',
			'subjects',
			'flowers',
            'countNoveltyProduct',
            'products'
		));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();

        $products_quantities = [];
        foreach ($data['products'] as $product) {
            if ($product['id']) {
                $products_quantities[$product['id']] = $product['quantity'];
            }
        }

        $data['products_quantities'] = $products_quantities;
        unset($data['products']);

        if ($data['type'] === Product::TYPE_BOUQUET) {
            if (!$products_quantities) {
                return redirect()->back()->withInput()->with([
                    'error' => "В букет необходимо добавить хотя бы один цветок"
                ]);
            }
            foreach ($products_quantities as $index => $quantity) {
                $flower = Product::find($index);
                if ($flower->quantity >= $quantity) {
                    $flower->quantity -= $quantity * $data['quantity'];
                    $flower->save();
                } else {
                    return redirect()->back()->withInput()->with([
                        'error' => "Превышено количество цветка '$flower->title_ru' для списания! Доступно на складе $flower->quantity"
                    ]);
                }
            }
        }

        $thumbnail = FileStorageService::upload($data['thumbnail']);
        $images = $data['product_photos'] ?? [];
        $data['thumbnail'] = $thumbnail;
        $product = Product::create($data);
		ImagesService::attach($product, 'productPhotos', $images, 1);
		$product->subjects()->attach($data['subjects']);
        if (isset($data['flowers'])) {
            $product->flowers()->attach($data['flowers']);
        }
		if ($product) {

			return redirect()->route('admin.products.index')
				->with(['status' => "Товар '{$product->title_uk}' успешно создан!"]);
		}

		return redirect()->back()->with(['error' => 'Что то пошло не так, попробуйте снова']);
    }

    public function show(string $id)
    {
        $product = Product::find($id);
        $productPhotos = $product->productPhotos()->orderBy('order')->get();
        return view('admin.products.show', compact('product', 'productPhotos'));
    }

    public function edit(string $id)
    {
        $countNoveltyProduct = Product::query()->where('is_novelty', true)->count();
		$subjects = Subject::all();
		$flowers = Flower::all();
        $product = Product::find($id);
        $categories = Category::all();
        $products = Product::products()->get();

        return view('admin.products.edit', compact(
			'product',
			'categories',
			'flowers',
			'subjects',
            'countNoveltyProduct',
            'products'
		));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();
        $product = Product::find($id);

        $products_quantities = [];

        if (isset($data['products'])) {
            foreach ($data['products'] as $prod) {
                if ($prod['id']) {
                    $products_quantities[$prod['id']] = $prod['quantity'];
                }
            }
        }

        $data['products_quantities'] = $products_quantities;
        unset($data['products']);

//        if (isset($data['type']) && $data['type'] === Product::TYPE_BOUQUET) {
//            if (!$products_quantities) {
//                return redirect()->back()->withInput()->with([
//                    'error' => "В букет необходимо добавить хотя бы один цветок"
//                ]);
//            }
//        }

        if (intval($data['quantity']) > intval($product->quantity) || $data['update_count'] && (isset($data['type']) && $data['type'] === Product::TYPE_BOUQUET)) {
            if ($data['update_count']) {
                $quantityDiff = intval($data['quantity']);
            } else {
                $quantityDiff = intval($data['quantity']) - intval($product->quantity);
            }
            foreach ($products_quantities as $index => $quantity) {
                $flower = Product::find($index);
                if ($flower->quantity >= $quantity) {
                    $flower->quantity -= $quantity * $quantityDiff;
                    $flower->save();
                } else {
                    return redirect()->back()->withInput()->with([
                        'error' => "Превышено количество цветка '$flower->title_ru' для списания! Доступно на складе $flower->quantity"
                    ]);
                }
            }
        }

        $flowers = $data['flowers'] ?? [];
		$currentFlowers = $product->flowers()->pluck('flowers.id')->toArray();
		$flowersToRemove = array_diff($currentFlowers, $flowers);

		$subjects = $data['subjects'] ?? [];
		$currentSubjects = $product->subjects()->pluck('subjects.id')->toArray();
		$subjectsToRemove = array_diff($currentSubjects, $subjects);

		if ($flowersToRemove) {
			$product->flowers()->detach($flowersToRemove);
		}

		if ($subjectsToRemove) {
			$product->subjects()->detach($subjectsToRemove);
		}

		$product->flowers()->attach($flowers);
		$product->subjects()->attach($subjects);

		if (isset($data['thumbnail'])) {
            FileStorageService::remove($data['thumbnail']);
            $thumbnail = FileStorageService::upload($data['thumbnail']);
            $data['thumbnail'] = $thumbnail;
        }

        if (isset($data['product_photos']) && !empty(array_filter($data['product_photos']))) {
            ImagesService::attach($product, 'productPhotos', $data['product_photos']);
        }

        if ($product->update($data)) {
            return redirect()->route('admin.products.index')
                ->with(['status' => "Товар '{$product->title_uk}' успешно изменен!"]);
        }

        return redirect()->back()->with(['error' => 'Что то пошло не так, попробуйте снова']);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $name = $product->title_uk;
        if ($product->orders()->count() === 0) {
            if ($product->type === Product::TYPE_BOUQUET) {
                foreach ($product->products_quantities as $id => $quantity) {
                    $prod = Product::find($id);
                    $prod->quantity += $quantity * $product->quantity;
                    $prod->save();
                }
            }
            $product->delete();
            return redirect()->route('admin.products.index')
                ->with(['status' => "Товар {$name} успешно удален!"]);
        } else {
            return redirect()->back()
                ->with(['error' => "Товар {$name} невозможно удалить!"]);
        }
    }

    public function getArticle()
    {
        $product = Product::query()->orderBy('article', 'desc')->first();

        if ($product) {
            $newArticle = $product->article + 1;
            return str_pad($newArticle, 7, '0', STR_PAD_LEFT);
        }

        return '0000001';
    }

    public function sortNovelty()
    {
        $novelty = Product::query()->where('is_novelty', true)->orderBy('order')->get();
        return view('admin.products.novelty-sort', compact('novelty'));
    }

    public function sortNoveltyUpdate(Request $request)
    {
        $data = $request->all();
        $order = 1;
        foreach ($data['photoIds'] as $photoId) {
            $entity = Product::find($photoId);
            $entity->order = $order;
            $entity->save();
            $order++;
        }
        return response()->json();
    }
}
