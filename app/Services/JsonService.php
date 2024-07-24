<?
namespace App\Services;

class JsonService
{
	private $message;
	private $name;
	private $x;
	private $y;

	public function __construct ($args)
	{
		$this->message 	= is_array ($args['message']) ? $args['message'][0] : $args['message'];
		$this->name		= $args['name'];
	}

	/**
	* get an instance of this class
	* 
	* @param array $args
	* @return App\Services\JsonService
	*/
	public static function instance($args = [])
	{
		return new self($args);
	}

	/**
	* make a preparation string
	* 
	* @param string $method
	* @return void
	*/
	private function prepareMethod($method)
	{
		$this->y = $method . "('" . $this->message . "','" . $this->name . "');";
	}

	/**
	* make output json string for sending this to the browser
	* 
	* @return string
	*/
	private function out()
	{
		$this->x = '[ { "n": "js", "d": "' . $this->y . '" } ]';
		$arX = [
			"n" => "js",
			"d" => $this->y
		];
		$this->x = '[ ' . json_encode ($arX) . ' ]';
		return $this->x;
	}

	/**
	* shows error message in the comments in json
	* 
	* @param array|string $message
	* @param string $name
	* @param string $target
	* @return string JSON
	*/
	public static function showErrorMessage($message, $name = '') 
	{
		$args = ['message' => $message, 'name' => $name];
		$class = self::instance($args);
		$class->prepareMethod('jcomments.error');
		return $class->out();
	}

	/**
	* shows message with information in the comments in json
	* 
	* @param array|string $message
	* @param string $target
	* @return string JSON
	*/
	public static function showInfoMessage( $message, $name = '') {
		$args = ['message' => $message, 'name' => $name];
		$class = self::instance($args);
		$class->prepareMethod('jcomments.message');
		return $class->out();
	}
}