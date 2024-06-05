<?php

namespace App\Traits;

trait Pagination {

	 /**
     * Get paginnation array with links
     * @param  App\Models\Item  $items
     * @return array
     */
	public function getPaginationLinks ($items)
	{
		$pagination = $items->toArray()['links'];
		$pagination[0] = str_replace (' Previous','', $pagination[0]);
		$ind = count ($pagination) - 1;
		$pagination[$ind] = str_replace ('Next ','', $pagination[$ind]);
		return $pagination;
	}
}