<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Services\FileStorageService;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.banners.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBannerRequest $request)
    {
        $data = $request->validated();
        $image = FileStorageService::upload($data['image']);
        $data['image'] = $image;
        $banner = Banner::create($data);
        if ($banner) {
            return redirect()->route('admin.banners.index')->with(['status' => 'Постер успешно создан!']);
        }
        return redirect()->back()->with(['error' => 'Что то пошло не так']);
    }

    public function show(string $id)
    {
        $banner = Banner::find($id);
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        $products = Product::all();
        return view('admin.banners.edit', compact('products', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $data = $request->validated();
        $banner = Banner::find($id);
        if (isset($data['image'])) {
            FileStorageService::remove($banner->image);
            $image = FileStorageService::upload($data['image']);
            $data['image'] = $image;
        }

        if ($banner->update($data)) {
            return redirect()->route('admin.banners.index')->with(['status' => 'Постер успешно обновлен!']);
        }
        return redirect()->back()->with(['error' => 'Что то пошло не так']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        FileStorageService::remove($banner->image);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with(['status' => 'Постер удален успешно!']);
    }
}
