<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Interfaces\PostInterface;

use App\Models\Post;

class HomeController extends Controller
{
	public $countPerPage 	= 10;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(
		protected PostInterface $postRepository
	)
	{
	}

 	/**
	 * Show a home page
     * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$posts	= $this->postRepository->getAllHome($this->countPerPage);
		$data = [
			'posts'			=> $posts,
		];
		return view('home', $data);
	}
}
