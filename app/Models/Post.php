<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
	* get articles for the main page
    * @param  int $count
	* @return \Illuminate\Database\Eloquent\Collection 
	*/		
	public static function getAllHome($count = 0)
    {
		$items = self::select('*')
			->where('state', '>', '0')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('jos1_content_frontpage')
                      ->whereRaw('jos1_content.id = jos1_content_frontpage.content_id');
            })
			->with('category')
			->orderBy('ordering', 'asc')
            ->get();



        return $items;
    }
	
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
