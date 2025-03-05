<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryShortResource;
use App\Http\Resources\CommentShortResource;

class PostResource extends JsonResource
{
	/**
	* Transform the resource into an array.
	*
	* @return array<string, mixed>
	*/
	public function toArray(Request $request): array
	{
		return [
			'id'				=> $this->id,
			'title'				=> $this->title,
			'slug'				=> $this->alias,
			'category'			=> new CategoryShortResource($this->category),
			'introtext'			=> $this->introtext,
			'fulltext'			=> $this->fulltext,
			'comments'			=> CommentShortResource::collection($this->comments)->resolve()
		];
	}
}
