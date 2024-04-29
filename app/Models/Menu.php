<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
	use HasFactory;

	protected $table = 'jos1_menu';

	/**
	* get menu
    * @param  string $menuType
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public static function get($menuType = '')
	{
		$items = self::select('*')
		->where('menutype', $menuType)
		->where('published', '>', '0')
		->orderBy('ordering', 'asc')
		->get();

   
		return $items;
	}
}
