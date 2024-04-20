<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title_uk',
        'title_ru',
        'link',
        'btn_text_uk',
        'btn_text_ru',
        'image',
        'is_active',
    ];

    public function imageUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['image'])
        );
    }

    public function title(): Attribute
    {
		$locale = App::getLocale();
        return new Attribute(
            get: fn() => $this->attributes['title_'.$locale] ?? $this->attributes['title_uk']
        );
    }

    public function btnText(): Attribute
    {
		$locale = App::getLocale();
        return new Attribute(
            get: fn() => $this->attributes['btn_text_'.$locale] ?? $this->attributes['btn_text_uk']
        );
    }
}
