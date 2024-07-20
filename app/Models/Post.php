<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryHome;

class Post extends Model
{
	use HasFactory;

	protected $table = 'jos1_content';
	protected $with = ['comments'];
	protected $voteClass = [
		'0'	 => 'vote-none',
		'1'	 => 'vote-good',
		'-1' => 'vote-poor'
		];

	/**
    * get post for the home page
    */		
	public function postsFrontend()
	{
		return $this->hasOne(
			Frontpage::class,
			'content_id',
			'id')
			->orderBy('ordering', 'desc');
	}

	/**
    * get category for the article
    */
	public function category()
    {
        return $this->belongsTo(CategoryHome::class, 'catid', 'id');
    }

	/**
    * get article comments
    */
	public function comments()
    {
        return $this->hasMany(Comment::class, 'object_id', 'id')->where('published', 1);
    }
	
	/**
    * get vote class

	* @return array
    */
	public function getVoteClass()
	{
		return $this->voteClass;
	}
}
