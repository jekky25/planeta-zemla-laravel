<?
namespace App\Services;

class JsonService
{
	 /**
     * shows error message in the comments in json
     * 
     * @param array|string $message
     * @param string $name
     * @param string $target
     * @return string JSON
     */
	public static function showErrorMessage($message, $name = '', $target = '') 
	{
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