<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title_ua',
        'title_ru',
        'link',
        'btn_text',
        'image',
        'is_active',
    ];

    public function imageUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['image'])
        );
    }
}
