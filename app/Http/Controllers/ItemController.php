<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\AddCommentRequest;
use App\Requests\GetCommentRequest;
use App\Requests\VoteCommentRequest;
use App\Http\Controllers\Controller;
use App\Actions\AddCommentAction;
use App\Actions\GetCommentsAction;
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
		protected PostInterface $postRepository, 
		protected VoteCommentRequest $requestVote)
	{
	}

	/**
	* Show an article page
	* @param  \Illuminate\Http\Request  $request
	* @param string $name
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function getItem($name, $id)
	{
		$post				= $this->postRepository->getById($id);
		$data = [
			'title'			=> $post->title . ' Земля как планета',
			'post'			=> new PostResource($post)
		];
		return Inertia::render('Post', $data);
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
		$arParams	= $request->post();
		if (empty ($arParams['jtxf'])) abort(404);
		$act 		= $arParams['jtxf'];
		switch ($act) {
			case 'JCommentsShowPage':
				$x = GetCommentsAction::handle(new GetCommentRequest($arParams));
				break;
			case 'JCommentsVoteComment':
				$x = SetVoteCommentAction::handle($this->requestVote);
				break;
			case 'JCommentsAddComment':
				$x = AddCommentAction::handle(new AddCommentRequest($arParams));
				break;
			default:
			abort(404);
		}
		return $x;
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