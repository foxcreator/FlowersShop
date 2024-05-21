<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\FileStorageService;
use App\Http\Services\ImagesService;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductPhotosController extends Controller
{
    public function sortPhoto(Request $request)
    {
        $data = $request->all();
        $order = 1;
        foreach ($data['photoIds'] as $photoId) {
            $entity = ProductPhoto::find($photoId);
            $entity->order = $order;
            $entity->save();
            $order++;
        }
        return response()->status();
    }

    public function uploadPhotos(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['product']);
        $entity = $product->productPhotos()->orderBy('order', 'desc')->first();
        $order = isset($entity->order) ? $entity->order + 1: 1;

        ImagesService::attach($product, 'productPhotos', $data['images'], $order);

    }

    public function delete(Request $request)
    {
        try {
            $photo = ProductPhoto::find($request->photoId);
            FileStorageService::remove($photo->file_name);
            $photo->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
