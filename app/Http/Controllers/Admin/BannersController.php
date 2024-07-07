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
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.banners.create', compact('products'));
    }

    public function store(CreateBannerRequest $request)
    {
        $data = $request->validated();
        $image = FileStorageService::upload($data['image']);
        $data['image'] = $image;
        if ($data['product_id']) {
            $data['link'] = 'product/'.$data['product_id'];
        }
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

    public function edit(string $id)
    {
        $banner = Banner::find($id);
        $products = Product::all();
        return view('admin.banners.edit', compact('products', 'banner'));
    }

    public function update(UpdateBannerRequest $request, string $id)
    {
        $data = $request->validated();
        $banner = Banner::find($id);
        if ($data['product_id']) {
            $data['link'] = 'product/'.$data['product_id'];
        }

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

    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        FileStorageService::remove($banner->image);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with(['status' => 'Постер удален успешно!']);
    }
}
