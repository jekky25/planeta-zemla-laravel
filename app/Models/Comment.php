<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPrepareText;
use Carbon\Carbon;

class Comment extends Model
{
	use HasFactory, HasPrepareText;

	public static $dateFormatForDb	= 'Y-m-d H:i:s';
	protected	$table 			= 'jos1_jcomments';
	protected	$with 			= ['votes'];
	protected	$fillable = [
		'lang',
		'comment',
		'date',
		'object_id',
		'post_id',
		'name',
		'username',
		'email',
		'ip',
		'published',
		'message'
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

	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->published	= 1;
			$model->ip			= request()->ip();
			$model->username	= $model->name;
			$model->object_id	= $model->post_id;
			$model->date	 	= Carbon::now()->format(self::$dateFormatForDb);
			$model->comment		= $model->message;
			$model->lang		= 'ru-RU';
			unset($model->post_id);
			unset($model->message);
		});
	}

	public function getVoteCountAttribute()
	{
		return (int)($this->isgood - $this->ispoor);
	}

	public function getCommentAttribute($val)
	{
		return $this->replace($val);
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
