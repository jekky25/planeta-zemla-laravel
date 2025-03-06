<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasFactory;

	protected	$table 			= 'jos1_jcomments';
	protected	$with 			= ['votes'];
	protected	$fillable = [
		'lang',
		'comment',
		'date',
		'object_id',
		'name',
		'username',
		'email',
		'ip'
	];

	protected	$attributes = [
		'comment' 			=> '',
		'date'				=> '1970-01-01 00:00:00',
		'checked_out_time' 	=> '1970-01-01 00:00:00',
		'object_group' 		=> 'com_content',
		'object_params'		=> ''
	];

	protected $typesOfVoteClass = [
		'0'		=> 'vote-none',
		'1'		=> 'vote-good',
		'-1'	=> 'vote-poor'
		];

	public		$timestamps 	= false;

	public function getVoteCountAttribute()
	{
		return (int)($this->isgood - $this->ispoor);
	}

	public function getVoteClassAttribute()
	{
		if ($this->isgood > $this->ispoor) return $this->typesOfVoteClass[1];
		if ($this->isgood < $this->ispoor) return $this->typesOfVoteClass[-1];
		return $this->typesOfVoteClass[0];
	}

	/**
	* get votes
	*/
	public function votes()
	{
		return $this->hasMany(Vote::class, 'commentid', 'id');
	}	
}
