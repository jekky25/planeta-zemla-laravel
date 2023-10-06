<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class Post extends Model
{
	use HasFactory;

	protected $table = 'jos1_content';
	protected $with = ['category', 'comments'];

	public static function getAllHome($count = 0)
    {
		$items = self::select('*')
			->where('state', '>', '0')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('jos1_content_frontpage')
                      ->whereRaw('jos1_content.id = jos1_content_frontpage.content_id');
            })
			->orderBy('ordering', 'asc')
            ->get();



        return $items;
    }

	public static function getAll($count = 0, $name)
    {
        $items = self::select('*')
			->where('post_type', 'post')
			->where('post_status', 'publish')
			->orderBy('post_date', 'DESC')
			->paginate($count);

       
        return $items;
    }

	public static function getById($id)
    {
        $item = self::select('*')
			->where('ID', $id)
			->first();

       
        return $item;
    }

	public function postsFrontend()
	{
		return $this->hasOne(
			Frontpage::class,
			'content_id',
			'id')
			->orderBy('ordering', 'desc');
	}

	public function category()
    {
        return $this->belongsTo(Category::class, 'catid', 'id');
    }

	public function comments()
    {
        return $this->hasMany(Comment::class, 'object_id', 'id')->where('published', 1);
    }
	
}
