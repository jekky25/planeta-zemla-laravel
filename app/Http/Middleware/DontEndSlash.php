<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Config;


class DontEndSlash
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
		//check url for the presence of a trailing slash
		if (!preg_match('/.+\/$/', $request->getRequestUri()))
		{            
		$base_url = Config::get('app.url');
		
		//dd($base_url, $request->getRequestUri());

		return Redirect::to($base_url.$request->getRequestUri().'/');
	}

	/*
	if (!str_ends_with($request->getPathInfo(), '/')) {
		$newval =$request->getPathInfo().'/';
		header("HTTP/1.1 301 Moved Permanently");
		header("Location:$newval");
		exit();
	}
	*/

	return $next($request);
    
	}
}

