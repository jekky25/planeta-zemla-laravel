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

class ItemController extends Controller
{
	public 	$dateFormat = 'd.m.Y H:i';
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
	public function getItem(Request $request, $name, $id)
	{
		$post   = Post::getById($id);

		if (empty ($post)) abort(404);


		$title = $post->title . ' Земля как планета';

		
	
		if (!empty ($post->comments))
		{
			foreach ($post->comments as &$item)
			{
				$date 		= \Carbon\Carbon::parse($item->date)->format($this->dateFormat);
				$item->date = $date;
			}
		}

		return view('post')
		->with(compact('title'))
        ->with(compact('post'));
	}


	public function getRss(Request $request, $name, $id)
	{
		$post   = Post::getById($id);

		if (empty ($post)) abort(404);

		$startStr = '<?xml version="1.0" encoding="utf-8"?>';

		$mTime = \Carbon\Carbon::now();
		$refreshTime = $mTime->format('D, d M Y H:i:s +0000');

		foreach ($post->comments as &$item)
		{
			$mTime = \Carbon\Carbon::create($item->date);
			$postTime = $mTime->format('D, d M Y H:i:s +0000');

			$item->dateStr = $postTime;
		}

		

		return response()
		->view ('post.rss', [
			'startStr'		=> $startStr,
			'post'			=> $post,
			'refreshTime'	=> $refreshTime
		])
		->header('Content-Type', 'application/xml');
	}
}
