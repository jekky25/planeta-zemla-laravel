<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\PostInterface;

class HomeController extends Controller
{
	public $countPerPage 	= 10;
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
		protected PostInterface $postRepository)
	{
	}

 	/**
	* Show a home page
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$posts	= $this->postRepository->getAllHome($this->countPerPage);
		$data = [
			'posts'			=> $posts,
		];
		return view('home', $data);
	}
}