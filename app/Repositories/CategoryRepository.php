<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface {

    /**
     * Get category by Name
     * @param  string  $name
     * @return \App\Database\Eloquent\Collection 
     */
    public static function getByName($name)
	{
		return Category::select('*')
			->where('alias', $name)
			->first();
	}
}