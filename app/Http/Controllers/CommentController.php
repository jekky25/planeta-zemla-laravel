<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCommentRequest;
use App\Repositories\CommentRepository;
use App\Http\Resources\CommentShortResource;

class CommentController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
	}

	/**
	* get comment by id
	*
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
	public function get(CommentRepository $comment, $id)
	{
		return new CommentShortResource($comment->getById($id));
	}

	/**
	* create a comment of the post
	*
	* @param  AddCommentRequest  $request
	* @param  CommentRepository  $comment
	* @return \Illuminate\Http\Response
	*/
	public function store(AddCommentRequest $request, CommentRepository $comment)
	{
		$comment->create($request->validated());
		return response()->json(['success' => 1]);
	}
}
