<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

	protected $fillable = [
		'name_ua',
		'name_ru'
	];

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
}
