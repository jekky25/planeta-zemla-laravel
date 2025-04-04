<?
namespace App\Services;

use Illuminate\Pagination\Paginator;
use App\Services\LengthPaginator as LengthPaginator;

abstract class LengthPager
{
	/**
	* Create paginator
	*
	* @param  Illuminate\Support\Collection  $collection
	* @param  int     $total
	* @param  int     $perPage
	* @return string
	*/
	public static function makeLengthAware($collection, $total, $perPage)
	{
		$trailingSlash = '/';
		$path = Paginator::resolveCurrentPath() . $trailingSlash;

		$paginator = new LengthPaginator(
			$collection->items(), $total, $perPage, Paginator::resolveCurrentPage(), ['path' => $path]
		);
		return $paginator;
	}
}