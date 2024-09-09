<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const BADGE_SALE = 'sale';
    const BADGE_NEW_PRICE = 'newPrice';
    const BADGE_HIT = 'hit';
    const BADGE_NEW = 'new';
    const TYPE_BOUQUET = 'bouquet';
    const TYPE_FLOWER = 'flower';
    const TYPE_DEFAULT = 'default';
    const TYPE_SUBSCRIBE = 'subscribe';

    const BADGES = [
        self::BADGE_HIT => 'Хит',
        self::BADGE_SALE => 'Скидка',
        self::BADGE_NEW_PRICE => 'Новая цена',
        self::BADGE_NEW => 'Новинка',
    ];

    const BADGES_UA = [
        self::BADGE_HIT => 'Хіт',
        self::BADGE_SALE => 'Знижка',
        self::BADGE_NEW_PRICE => 'Нова ціна',
        self::BADGE_NEW => 'Новинка',
    ];
    const TYPES = [
        self::TYPE_FLOWER => 'Цветок',
        self::TYPE_BOUQUET => 'Букет',
        self::TYPE_DEFAULT => 'Другое',
        self::TYPE_SUBSCRIBE => 'Подписка',
    ];

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title_uk',
        'title_ru',
        'price',
        'description_uk',
        'description_ru',
        'quantity',
        'article',
        'thumbnail',
        'badge',
        'rating',
        'is_novelty',
        'type',
        'products_quantities',
        'opt_price'
    ];

    protected $casts = [
        'products_quantities' => 'array',
    ];

    public function productPhotos():HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

	public function subjects()
    {
		return $this->belongsToMany(Subject::class);
	}

	public function flowers()
    {
		return $this->belongsToMany(Flower::class);
	}

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function video()
    {
        return $this->hasOne(ProductVideo::class);
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['thumbnail'])
        );
    }

	public function title():Attribute
	{
		$locale = App::getLocale();
		return new Attribute(
			get: fn() => $this->attributes['title' . '_' . $locale] ?? $this->attributes['title_uk']
		);
	}

	public function description():Attribute
	{
		$locale = App::getLocale();
		return new Attribute(
			get: fn() => $this->attributes['description' . '_' . $locale] ?? $this->attributes['description_uk']
		);
	}

    public function getBadgeNameAttribute(): string
    {
        return self::BADGES[$this->attributes['badge']] ?? '';
    }

    public function getTypeNameAttribute(): string
    {
        return self::TYPES[$this->attributes['type']] ?? '';
    }

    public function getBadgeNameMultiLangAttribute(): string
    {
        if (App::getLocale() === 'ru') {
            return self::BADGES[$this->attributes['badge']] ?? '';
        }
        return self::BADGES_UA[$this->attributes['badge']] ?? '';

    }

    public function scopeBouquets($query)
    {
        return $query->where('type', 'bouquet');
    }

    public function scopeProducts($query)
    {
        return $query->where('type', 'flower');
    }

    public function getProducts()
    {
        $products = collect();
        if($this->products_quantities) {
            foreach ($this->products_quantities as $productId => $quantity) {
                $product = self::find($productId);
                if ($product) {
                    $products->push(['product' => $product, 'quantity' => $quantity]);
                }
            }
        }
        return $products;
    }

    public function removeFromCart()
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$this->id])) {
            if ($cart[$this->id]['quantity'] > 1) {
                $cart[$this->id]['quantity']--;
            } else {
                unset($cart[$this->id]);
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('status', "$this->title_uk удален из чека");
        }

        return redirect()->back()->with('error', 'Товар не найден в чеке');
    }
}
