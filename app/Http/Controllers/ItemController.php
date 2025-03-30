<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VoteCommentRequest;
use App\Http\Controllers\Controller;
use App\Actions\SetVoteCommentAction;
use App\Interfaces\PostInterface;
use App\Http\Resources\PostResource;
use Inertia\Inertia;

class ItemController extends Controller
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
	* Show an article page
	* @param  \Illuminate\Http\Request  $request
	* @param string $name
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function get($name, $id)
	{
		$post				= $this->postRepository->getById($id);
		return Inertia::render('Post', ['post' => new PostResource($post)]);
	}

	/**
	* Show rss on the page
	* @param  \Illuminate\Http\Request  $request
	* @param string $name
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function getRss($name, $id)
	{
		$post 	= $this->postRepository->getById($id);
		$data = [
			'post'			=> $post,
			'refreshTime'	=> $this->postRepository->getDateFormatToRss(\Carbon\Carbon::now())
		];

		return response()
		->view ('post.rss', $data)
		->header('Content-Type', 'application/xml');
	}

	/**
	* get ajax requests
	* @param  \Illuminate\Http\Request  $request
	* @return string JSON
	*/
	public function getAjax(Request $request)
	{
		return true;
	}

	/**
	* update city in admin
	*
	* @param  VoteCommentRequest  $request
	* @param  int $id
	* @return bool
	*/
	public function update(VoteCommentRequest $request, $id)
	{
		return SetVoteCommentAction::handle($request->validated(), $id);
	}

	/**
	* Get all posts
	* @param  PostInterface $post
	* @return json
	*/
	public function getAll(PostInterface $post)
	{
		return PostResource::collection($post->getAllHome($this->countPerPage));
	}
}