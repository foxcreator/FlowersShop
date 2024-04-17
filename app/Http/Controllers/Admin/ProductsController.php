<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileStorageService;
use App\Http\Services\ImagesService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $article = $this->getArticle();
        return view('admin.products.create', compact('categories', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        $thumbnail = FileStorageService::upload($data['thumbnail']);
        $images = $data['product_photos'] ?? [];
        $data['thumbnail'] = $thumbnail;
        $product = Product::create($data);
        ImagesService::attach($product, 'productPhotos', $images, 1);
        if ($product) {
            return redirect()->route('admin.products.index')
                ->with(['status' => "Товар '{$product->title_ua}' успешно создан!"]);
        }

        return redirect()->back()->with(['error' => 'Что то пошло не так, попробуйте снова']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $productPhotos = $product->productPhotos()->orderBy('order')->get();
        return view('admin.products.show', compact('product', 'productPhotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();
        $product = Product::find($id);
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
                ->with(['status' => "Товар '{$product->title_ua}' успешно изменен!"]);
        }

        return redirect()->back()->with(['error' => 'Что то пошло не так, попробуйте снова']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $name = $product->title_ua;
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

        // Верните HTML содержимое таблицы
        return view('admin.products.blocks.table', compact('products'))->render();
    }
}
