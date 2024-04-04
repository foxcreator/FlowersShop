<?php

namespace App\Models;

use App\Http\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'order'];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function setFileNameAttribute($image)
    {
        $this->attributes['file_name'] = FileStorageService::upload($image);
    }



    public function fileNameUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['file_name'])
        );
    }
}
