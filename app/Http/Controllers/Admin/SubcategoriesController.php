<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::paginate(20);
        return view('admin.categories.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.subcategories.create', compact('categories'));
    }

    public function store(CreateSubcategoryRequest $request)
    {
        $subcategory = Subcategory::create($request->validated());
        if ($subcategory) {
            return redirect()->route('admin.subcategories.index')->with('status', 'Подкатегория успешно добавлена');
        }

        return redirect()->back()->with('error', 'Smth gone wrong');
    }

    public function edit(string $id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.categories.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(UpdateSubcategoryRequest $request, string $id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory->update($request->validated())) {
            return redirect()->route('admin.subcategories.index')->with('status', 'Подкатегория успешно обновлена');
        }

        return redirect()->back()->with('error', 'Smth gone wrong');
    }

    public function destroy(string $id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory->delete()) {
            return redirect()->route('admin.subcategories.index')->with('status', 'Подкатегория успешно удалена');
        }

        return redirect()->back()->with('error', 'Smth gone wrong');
    }
}
