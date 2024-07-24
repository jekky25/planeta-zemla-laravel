<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MenuRepository;
use App\Interfaces\MenuInterface;

class MenuServiceProvider extends ServiceProvider
{
	/**
	* Register services.
	*
	* @return void
	*/
	public function register()
	{
		$this->app->bind(MenuInterface::class, MenuRepository::class);
	}

	/**
	* Bootstrap services.
	*
	* @return void
	*/
	public function boot(MenuInterface $menuRepository)
	{
		$menuH 		= $menuRepository->get ('mainmenu');
		$menuLeft 	= $menuRepository->get ('topmenu');
		view()->share(['menuH' => $menuH, 'menuLeft' => $menuLeft]);
    }
}
