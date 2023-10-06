<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Menu;

class MenuServiceProvider extends ServiceProvider
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
		$menuH 		= Menu::get ('mainmenu');
		$menuLeft 	= Menu::get ('topmenu');
		view()->share(['menuH' => $menuH, 'menuLeft' => $menuLeft]);
    }
}
