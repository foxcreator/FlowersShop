<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileStorageService;
use App\Http\Services\ImagesService;
use App\Models\Category;
use App\Models\Flower;
use App\Models\Product;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort');
        if ($sortBy) {
            $products = Product::where('quantity', 0)->get();
        } else {
            $products = Product::where(null, null)->paginate(10);
        }
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $flowers = Flower::all();
        $subjects = Subject::all();
        $article = $this->getArticle();
        return view('admin.products.create', compact(
			'categories',
			'article',
			'subjects',
			'flowers'
		));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();

        $thumbnail = FileStorageService::upload($data['thumbnail']);
        $images = $data['product_photos'] ?? [];
        $data['thumbnail'] = $thumbnail;
        $product = Product::create($data);
		ImagesService::attach($product, 'productPhotos', $images, 1);
		$product->subjects()->attach($data['subjects']);
		$product->flowers()->attach($data['flowers']);
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
		$subjects = Subject::all();
		$flowers = Flower::all();
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact(
			'product',
			'categories',
			'flowers',
			'subjects'
		));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
		$data = $request->validated();
		$product = Product::find($id);
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
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with(['status' => "Товар {$name} успешно удален!"]);
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

    public function fetchData(Request $request)
    {
        $sort = $request->input('sort');
        $count = $request->input('count');
        if($sort === 'all') {
            $products = Product::paginate($count);
        } else {
            $products = Product::where('quantity', 0)->paginate($count);
        }

        return view('admin.products.blocks.table', compact('products'))->render();
    }
}
