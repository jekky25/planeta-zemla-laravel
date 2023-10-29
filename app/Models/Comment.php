<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

	public		$timestamps 	= false;

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
