<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
	use HasFactory;

	protected $table = 'jos1_sections';

	public static function getByName($name)
	{
		$items = self::select('*')
			->where('alias', $name)
			->first();
		
		return $items;
	}
}
