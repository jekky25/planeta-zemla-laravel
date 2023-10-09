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


		$title = $post->title . ' Земля как плванета';

		return view('post')
		->with(compact('title'))
        ->with(compact('post'));
	}
}
