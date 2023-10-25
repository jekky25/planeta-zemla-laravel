<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
	use HasFactory;

	protected $table = 'jos1_jcomments';

	protected $with = ['votes'];

	public static function getById($id)
    {
        $item = self::select('*')
			->where('id', $id)
			->first();

        return $item;
    }

	public function votes()
    {
		$ip = request()->ip();
		
        return $this->hasMany(Vote::class, 'commentid', 'id')->where('ip', $ip);
    }	
}
