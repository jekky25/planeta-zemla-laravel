<?php

use Illuminate\Support\Facades\DB;

//google re-capcha keys
define("RE_SITE_KEY","6LfD7VYkAAAAAC38VoG0yb2jeedEnV276kMTuwTb");
define("RE_SEC_KEY","6LfD7VYkAAAAADvURBFXjV0Pjc1dxL_8NLt1RN47");

//out error messages
if (!function_exists('showErrorMessage')) {
	function showErrorMessage( $message, $name = '', $target = '') {
		$message = is_array ($message) ? $message[0] : $message;
		$y = "jcomments.error('" . $message . "','" . $name . "');";
		$x = '[ { "n": "js", "d": "' . $y . '" } ]';
		$arX = [
			"n" => "js",
			"d" => $y

		];
		$x = '[ ' . json_encode ($arX) . ' ]';
		return $x;
	}
}