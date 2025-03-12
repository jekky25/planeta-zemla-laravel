<?php
declare(strict_types=1);

namespace App\Traits;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Modules\BBCode\B;
use App\Modules\BBCode\I;
use App\Modules\BBCode\U;
use App\Modules\BBCode\S;
use App\Modules\BBCode\Nl2Br;
use App\Modules\BBCode\Sup;
use App\Modules\BBCode\Sub;
use App\Modules\BBCode\Hide;
use App\Modules\BBCode\Quote;

/**
 * Trait HasFilter
 *
 * @method static Builder filter(Filter $filter)
 */
trait HasPrepareText
{
	private $patterns		= [];
	private $replacements	= [];
	private $strReplace		= '';

	private $mapBBCode	= 
	[
		Nl2Br::class,
		B::class,
		I::class,
		U::class,
		S::class,
		Sup::class,
		Sub::class,
		Hide::class,
		Quote::class
	];

	/**
	 * Replaces BBCODES
	 * @param  string $text
	 * @return string
	 */
	public function replace($str) {
		foreach ($this->mapBBCode as $class)
		{
			$obj = new $class($str);
			$str = $obj->replace();
		}
		$str = preg_replace('#\[\/?(b|i|u|s|sup|sub|url|img|list|quote|code|hide)\]#u', '', $str);
		return $str;
	}
}