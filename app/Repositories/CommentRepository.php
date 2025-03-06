<?php

namespace App\Repositories;

use App\Interfaces\CommentInterface;
use App\Models\Comment;

class CommentRepository implements CommentInterface {

	/**
	* create a comment
	* @param  array $request
	* @return void
	*/	
	public function create($request) {
		try {
			Comment::create($request);
		} catch (\Exception $e) {
			throw new \Exception('Failed to create a comment '.$e->getMessage());
		}
	}

	/**
	* get comment by id
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/
	public function getById($id)
	{
		return Comment::select('*')
			->where('id', $id)
			->firstOrFail();
	}
}