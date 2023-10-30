<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
	public 	$countPerPage 	= 10;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getItem(Request $request, $name)
	{
		if (empty ($name)) abort(404);

		$category = Category::getByName ($name);

		if (empty ($category)) abort(404);

		$posts = Post::getAll($this->countPerPage, $category->id);

		

		foreach ($posts as &$item)
			$item['category'] = $category;

		$pagination = $posts->toArray()['links'];
		$pagination[0] = str_replace (' Previous','', $pagination[0]);
		$ind = count ($pagination) - 1;
		$pagination[$ind] = str_replace ('Next ','', $pagination[$ind]);

		$title = $category->title . ' Земля как планета';
        
		return view('home')
			->with(compact('title'))
			->with(compact('posts'))
			->with(compact('category'))
			->with(compact('pagination'));
	}
}
