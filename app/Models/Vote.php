<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
	use HasFactory;

	protected $table 	= 'jos1_jcomments_votes';
	public $timestamps 	= false;

	protected $fillable = [
		'commentid',
		'ip',
		'date',
		'value'
	  ];
}
