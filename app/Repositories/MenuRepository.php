<?php

namespace App\Repositories;

use App\Interfaces\MenuInterface;
use App\Models\Menu;

class MenuRepository implements MenuInterface {
	/**
	* get menu
	* @param  string $menuType
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public static function get($menuType = '')
	{
		$items = Menu::select('*')
		->where('menutype', $menuType)
		->where('published', '>', '0')
		->orderBy('ordering', 'asc')
		->get();
   		return $items;
	}
}