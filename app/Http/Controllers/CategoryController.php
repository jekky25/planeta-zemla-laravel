<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\LengthPager;
use App\Interfaces\CategoryInterface;
use App\Interfaces\PostInterface;
use App\Traits\Pagination;

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
	* @return \Illuminate\Http\Response
	*/
	public function getItem(Request $request, $name)
	{
		global $code_sape;

		if (empty ($name)) abort(404);
		$category = $this->categoryRepository->getByName($name);
		if (empty ($category)) abort(404);

		$posts 			= $this->postRepository->getAll($this->countPerPage, $category->id);
		$pagination		= $this->getPaginationLinks ($posts);

		$data = [
			'title'			=> $category->title . ' Земля как планета',
			'posts'			=> $posts,
			'category'		=> $category,
			'code_sape'		=> $code_sape,
			'pagination'	=> $pagination,
		];
		return response()->view('home', $data);
	}
}