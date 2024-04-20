<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImagesServiceContract
{
    public static function attach(Model $model, string $methodName, array $images =[]);
}
