<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VoteRepository;
use App\Interfaces\VoteInterface;

class VoteServiceProvider extends ServiceProvider
{
	/**
	* Register services.
	*
	* @return void
	*/
	public function register()
	{
	$this->app->bind(VoteInterface::class, VoteRepository::class);
	}

	/**
	* Bootstrap services.
	*
	* @return void
	*/
	public function boot()
	{
		//
	}
}