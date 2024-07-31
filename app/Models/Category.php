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
        'title_uk',
        'title_ru',
        'description_uk',
        'description_ru',
        'thumbnail',
        'is_show_on_homepage',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['thumbnail'])
        );
    }

    public function title(): Attribute
    {
		$locale = session('locale');
        return new Attribute(
            get: fn() => $this->attributes['title_'.$locale] ?? $this->attributes['title_uk']
        );
    }

    public function description(): Attribute
    {
		$locale = session('locale');
        return new Attribute(
            get: fn() => $this->attributes['description_'.$locale] ?? $this->attributes['description_uk']
        );
    }
}
