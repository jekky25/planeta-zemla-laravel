<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use App\Http\Resources\PostResource;
use App\Interfaces\PostInterface;
use App\Traits\Pagination;
use Inertia\Inertia;

class CategoryController extends Controller
{
	use Pagination;
	public 	$countPerPage 	= 10;

	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		protected CategoryInterface $categoryRepository,
		protected PostInterface $postRepository)
	{
	}

	/**
	* Show an article page in the category
	* @param  \Illuminate\Http\Request  $request
	* @param string $name
	* @return Inertia
	*/
	public function get($name)
	{
		global $code_sape;
		$category = $this->categoryRepository->getByName($name);
		$posts          = $this->postRepository->getAll($this->countPerPage, $category->id);
		$pagination     = $this->getPaginationLinks($posts);
		$data = [
			'posts'			=> PostResource::collection($posts)->resolve(),
			'category'		=> $category,
			'code_sape'		=> $code_sape,
			'pagination'	=> $pagination,
		];
		return Inertia::render('Home', $data);
	}
}
