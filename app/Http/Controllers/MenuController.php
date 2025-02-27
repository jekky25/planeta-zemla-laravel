<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;
use App\Http\Resources\MenuTopResource;
use App\Http\Resources\MenuLeftResource;

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
	public function getMenuTop(MenuRepository $menu)
	{
		return MenuTopResource::collection($menu->get('mainmenu'));
	}

	/**
	* Get left menu
	* @param  MenuRepository  $menu
	* @return json
	*/
	public function getMenuLeft(MenuRepository $menu)
	{
		return MenuLeftResource::collection($menu->get('topmenu'));
	}
}