<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
	/**
	* Register services.
	*
	* @return void
	*/
	public function register()
	{
        //
	}

	/**
	* Bootstrap services.
	*
	* @return void
	*/
	public function boot()
	{
		$PageTitle 	= !empty ($PageTitle)  	? $PageTitle 	: 'Планета Земля, Информация о Земле, Все про Землю';
		$MetaTags 	= !empty ($MetaTags) 	? $MetaTags 	: '<meta name="robots" content="index, follow" />
																<meta name="keywords" content="Планета Земля, Земля" />
																<meta name="description" content="Планета Земля, Информация о Земле, Все про Землю" />';

		view()->share(['title' => $PageTitle, 'MetaTags' => $MetaTags]);
    }
}
