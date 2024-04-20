<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flower;
use Illuminate\Http\Request;

class FlowersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$flowers = Flower::all();
        return view('admin.categories.flowers.index', compact('flowers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.flowers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
			'name_ua' => 'required',
			'name_ru' => 'required'
		]);

		$flower = Flower::create([
			'name_ua' => $request->name_ua,
			'name_ru' => $request->name_ru,
		]);

		if ($flower) {
			return redirect()->route('admin.flowers.index')->with(['status' => 'Категория цветка успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$flower = Flower::findOrFail($id);
        return view('admin.categories.flowers.edit', compact('flower'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
		$request->validate([
			'name_ua' => 'required',
			'name_ru' => 'required'
		]);

		$flower = Flower::update([
			'name_ua' => $request->name_ua,
			'name_ru' => $request->name_ru,
		]);

		if ($flower) {
			return redirect()->route('admin.flowers.index')->with(['status' => 'Категория цветка успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flower = Flower::findOrFail($id);
		$flower->delete();
		return redirect()->back()->with(['status' => 'Категория удалена!']);
    }
}
