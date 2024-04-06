<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ua',
        'title_ru',
        'description_ua',
        'description_ru',
        'thumbnail',
        'is_show_on_homepage',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['thumbnail'])
        );
    }
}
