<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\ImagesServiceContract;
use Illuminate\Database\Eloquent\Model;

class ImagesService implements ImagesServiceContract
{

    public static function attach(Model $model, string $methodName, array $images = [], $order = null)
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception($model::class . " doesn't have {$methodName}");
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                call_user_func([$model, $methodName])->create(['file_name' => $image, 'order' => $order]);
                $order++;
            }
        }
    }
}


