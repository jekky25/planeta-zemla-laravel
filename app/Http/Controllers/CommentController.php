<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCommentRequest;
use App\Repositories\CommentRepository;

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
