<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SearchHelper;
use App\Models\Flower;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $subjects = SearchHelper::search(
                Subject::class,
                ['name_ru', 'name_uk',],
                $request->search,
                ['name_uk' => 'asc'],
            );
        } else {
            $subjects = Subject::query()->orderBy('name_uk')->paginate(20);
        }
        return view('admin.categories.subjects.index', compact('subjects'));
    }

	public function create()
	{
		return view('admin.categories.subjects.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name_uk' => 'required',
			'name_ru' => 'required'
		]);

		$subject = Subject::create([
			'name_uk' => $request->name_uk,
			'name_ru' => $request->name_ru,
		]);

		if ($subject) {
			return redirect()->route('admin.subjects.index')->with(['status' => 'Тематика успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
	}

	public function edit(string $id)
	{
		$subject = Subject::findOrFail($id);
		return view('admin.categories.subjects.edit', compact('subject'));
	}

	public function update(Request $request, string $id)
	{
		$subject = Subject::find($id);
		$request->validate([
			'name_uk' => 'required',
			'name_ru' => 'required'
		]);

		$subject->update([
			'name_uk' => $request->name_uk,
			'name_ru' => $request->name_ru,
		]);

		if ($subject) {
			return redirect()->route('admin.subjects.index')->with(['status' => 'Тематика успешно создана']);
		}

		return redirect()->back()->with(['error' => 'Smth as wrong']);
	}

	public function destroy(string $id)
	{
		$subject = Subject::findOrFail($id);
		$subject->delete();
	}
}
