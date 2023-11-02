<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SapeServiceProvider extends ServiceProvider
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
		global $view, $code_sape, $sape, $sape_context;

		$code_sape = [];
        
		if (!defined('_SAPE_USER')) define('_SAPE_USER', '2985ac2e5fba128e432d8e4c54a11c6f');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/' . _SAPE_USER . '/sape.php');
		$o = [];
		$o['host'] = 'planeta-zemla.ru';
		$o['charset'] = 'UTF-8';
		$sape = new \SAPE_client($o);
		$sape_context = new \SAPE_context();

		for ($i = 0; $i < 10; $i++) {
			$code_sape_f = $sape->return_links(1);
			if (strlen($code_sape_f) > 0 ) {
				$code_sape[] = $code_sape_f;
			} else {
			  break;
			}
		}
    }

	/**
	* Replace text for Sape
	* @param string $text
	* @return void
	*/
	public static function replaceSapeCode($text)
    {
		global $code_sape, $sape_context;
		for ($i = 0; $i < count ($code_sape) ; $i++) {
	  
			$sapeCodeEmpt = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $code_sape[$i]);
			if (empty ($sapeCodeEmpt)) continue;
			$countStr = 0;
			$countStr = strpos ($text, '{sape_links}');
	
			if ($countStr == 0) break;
		  
			$text = substr_replace($text, '<br /><span class="rek"><span>*</span> ' . $code_sape[$i] . '</span><br />', $countStr, 12);
	
			unset($code_sape[$i]);
		}
		$text =  str_replace("{sape_links}\r\n<br/><br/>", '', $text);
		$text =  str_replace("{sape_links}\r\n<br><br>", '', $text);

		//Сапа
		if ( defined('_SAPE_USER') )
		$text = $sape_context->replace_in_text_segment($text);
		return $text;
	}

}
