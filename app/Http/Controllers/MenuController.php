<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;
use App\Http\Resources\MenuHResource;

class MenuController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(
	)
	{
	}

	/**
	* Get horisontal menu
	* @param  MenuRepository  $menu
	* @return json
	*/
	public function getMenuH(MenuRepository $menu)
	{
		return MenuHResource::collection($menu->get('mainmenu'));
	}
}