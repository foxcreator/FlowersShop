<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Services\FileStorageService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $countShowCategory = Category::query()->where('is_show_on_homepage', true)->count();
        return view('admin.categories.create', compact('countShowCategory'));
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();

        $thumbnail = $data['thumbnail'];
        $data['thumbnail'] = FileStorageService::upload($thumbnail);

        $product = Category::create($data);
        if ($product) {
            return redirect()->route('admin.categories.index')->with(['status' => 'Категория успешно создана!']);
        }

        return redirect()->back()->with(['error' => 'Что то пошло не так, повторите попытку']);
    }

    public function show(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        $countShowCategory = Category::query()->where('is_show_on_homepage', true)->count();
        return view('admin.categories.edit', compact('category', 'countShowCategory'));
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $category = Category::find($id);
        if (isset($data['thumbnail'])) {
            FileStorageService::remove($data['thumbnail']);
            $data['thumbnail'] = FileStorageService::upload($data['thumbnail']);
        }

        if ($category->update($data)) {
            return redirect()->route('admin.categories.index')->with(['status' => 'Категория успешно обновлена!']);
        }
        return redirect()->back()->with(['error' => 'Что то пошло не так, повторите попытку']);
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        FileStorageService::remove($category->thumbnail);
        $category->delete();

        return redirect()->route('admin.categories.index')->with(['success' => 'Категория удалена!']);
    }
}
