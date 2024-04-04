<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const BADGE_SALE = 'sale';
    const BADGE_NEW_PRICE = 'newPrice';
    const BADGE_HIT = 'hit';
    const BADGE_NEW = 'new';

    const BADGES = [
        self::BADGE_HIT => 'Хит',
        self::BADGE_SALE => 'Скидка',
        self::BADGE_NEW_PRICE => 'Новая цена',
        self::BADGE_NEW => 'Новинка',
    ];

    protected $fillable = [
        'category_id',
        'title_ua',
        'title_ru',
        'price',
        'description_ua',
        'description_ru',
        'quantity',
        'article',
        'thumbnail',
        'badge'
    ];

    public function productPhotos():HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['thumbnail'])
        );
    }

    public function getBadgeNameAttribute(): string
    {
        return self::BADGES[$this->attributes['badge']] ?? '';
    }
}
