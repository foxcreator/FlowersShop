<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
	public function index()
	{
		$subjects = Subject::all();
		return view('admin.categories.subjects.index', compact('subjects'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.categories.subjects.create');
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

		$subject = Subject::create([
			'name_ua' => $request->name_ua,
			'name_ru' => $request->name_ru,
		]);

		if ($subject) {
			return redirect()->route('admin.subjects.index')->with(['status' => 'Тематика успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$subject = Subject::findOrFail($id);
		return view('admin.categories.subjects.edit', compact('subject'));
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

		$subject = Subject::update([
			'name_ua' => $request->name_ua,
			'name_ru' => $request->name_ru,
		]);

		if ($subject) {
			return redirect()->route('admin.subjects.index')->with(['status' => 'Тематика успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$subject = Subject::finOrFail($id);
		$subject->delete();
	}
}
