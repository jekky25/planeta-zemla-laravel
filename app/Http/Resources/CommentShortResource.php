<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentShortResource extends JsonResource
{
	/**
	* Transform the resource into an array.
	*
	* @return array<string, mixed>
	*/
	public function toArray(Request $request): array
	{
		return [
			'id'			=> $this->id,
			'name'			=> $this->name,
			'date'			=> $this->date,
			'text'			=> $this->comment,
			'votes'			=> VoteShortResource::collection($this->votes)->resolve()
		];
	}
}
