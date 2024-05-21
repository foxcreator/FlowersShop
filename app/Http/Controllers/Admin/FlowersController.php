<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SearchHelper;
use App\Models\Flower;
use Illuminate\Http\Request;

class FlowersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $flowers = SearchHelper::search(
                Flower::class,
                ['name_ru', 'name_uk',],
                $request->search,
                ['name_uk' => 'asc'],
            );
        } else {
            $flowers = Flower::query()->orderBy('name_uk')->paginate(20);
        }
        return view('admin.categories.flowers.index', compact('flowers'));
    }

    public function create()
    {
        return view('admin.categories.flowers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
			'name_uk' => 'required',
			'name_ru' => 'required'
		]);

		$flower = Flower::create([
			'name_uk' => $request->name_uk,
			'name_ru' => $request->name_ru,
		]);

		if ($flower) {
			return redirect()->route('admin.flowers.index')->with(['status' => 'Категория цветка успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
    }

    public function edit(string $id)
    {
		$flower = Flower::findOrFail($id);
        return view('admin.categories.flowers.edit', compact('flower'));
    }

    public function update(Request $request, string $id)
    {
		$flower = Flower::find($id);
		$request->validate([
			'name_uk' => 'required',
			'name_ru' => 'required'
		]);

		$flower->update([
			'name_uk' => $request->name_uk,
			'name_ru' => $request->name_ru,
		]);

		if ($flower) {
			return redirect()->route('admin.flowers.index')->with(['status' => 'Категория цветка успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
    }

    public function destroy(string $id)
    {
        $flower = Flower::findOrFail($id);
		$flower->delete();
		return redirect()->back()->with(['status' => 'Категория удалена!']);
    }
}
