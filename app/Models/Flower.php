<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

	protected $fillable = [
		'name_uk',
		'name_ru',
	];

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}

	public function name(): Attribute
	{
		$locale = session('locale');
		return new Attribute(
			get: fn() => $this->attributes['name_'.$locale] ?? $this->attributes['name_uk']
		);
	}
}
