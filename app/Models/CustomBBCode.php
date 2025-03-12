<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBBCode extends Model
{
	use HasFactory;

	protected $table = 'jos1_jcomments_custom_bbcodes';

	public function getPatternModifyAttribute()
	{
		$patternModify = '#' . $this->pattern . '#ismu';
		return preg_replace('#(\\\w)#u', '\p{L}', $patternModify);
	}
}
