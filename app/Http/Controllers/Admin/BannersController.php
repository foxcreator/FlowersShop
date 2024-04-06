<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBannerRequest;
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
        dd($request->validated());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
