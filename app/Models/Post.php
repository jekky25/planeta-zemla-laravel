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
	* get all articles or all articles for the section
    * @param  int $count
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/	
	public static function getAll($count = 0, $id = 0)
    {
		if ((int) $id == 0) abort(404);

        $items = self::select('*')
			->where('state', '>', '0')
			->where('sectionid', $id)
			->orderBy('ordering', 'asc')
			->paginate($count);

        return $items;
    }

	/**
	* get an article by id
	* @param  int $id
	* @return \Illuminate\Database\Eloquent\Collection 
	*/	
	public static function getById($id)
    {
        $item = self::select('*')
			->where('ID', $id)
			->first();

		foreach ($item->comments as &$_item)
		{
			$_item->voteClass = $item->voteClass[0];
			if ($_item['isgood'] > $_item['ispoor']) $_item->voteClass = $item->voteClass[1];
			if ($_item['isgood'] < $_item['ispoor']) $_item->voteClass = $item->voteClass[-1];
			$_item['voteCount'] =  $_item['isgood'] - $_item['ispoor'];
		}
        return $item;
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
