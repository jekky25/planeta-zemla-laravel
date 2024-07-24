<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Requests\AddCommentRequest;
use App\Requests\GetCommentRequest;
use App\Requests\VoteCommentRequest;
use App\Http\Controllers\Controller;
use App\Actions\AddCommentAction;
use App\Actions\GetCommentsAction;
use App\Actions\SetVoteCommentAction;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Interfaces\PostInterface;

use Validator;

class ItemController extends Controller
{
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
	public function getItem(Request $request, $name, $id)
	{
		$post 			= $this->postRepository->getById($id);
		$post->fulltext = $this->postRepository->getSapeCode($post);
		if (empty ($post)) abort(404);

		$data = [
			'title'			=> $post->title . ' Земля как планета',
			'post'			=> $post
		];
		return response()->view('post', $data);
	}

	/**
	* Show rss on the page
	* @param  \Illuminate\Http\Request  $request
	* @param string $name
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function getRss(Request $request, $name, $id)
	{
		$post 	= $this->postRepository->getById($id);
		if (empty ($post)) abort(404);
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
		$arParams 	= $request->post();
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
}