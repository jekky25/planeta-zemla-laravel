<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Services\LengthPager;
use App\Models\Post;

class PostRepository implements PostInterface {

    /**
	* get all articles or all articles for the section
    * @param  int $count
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/	
	public static function getAll(int $count, int $id)
	{
		if ((int) $id == 0) abort(404);

		$items = Post::select('*')
			->where('state', '>', '0')
			->where('sectionid', $id)
			->orderBy('ordering', 'asc')
			->paginate($count);
		
		return LengthPager::makeLengthAware($items, $items->total(), $count);
	}
}