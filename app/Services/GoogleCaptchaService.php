<?
namespace App\Services;

use App\Services\JsonService;

class GoogleCaptchaService
{
	private $url			= 'https://www.google.com/recaptcha/api/siteverify';
	private $secret			= RE_SEC_KEY;
	private $output;
	private $remoteip		= '127.0.0.1';
	private $response;
	private $recaptcha;
	private $score	 		= '0.3';
	private $success	 	= false;
	private $error		 	= false;
	private $errorMessage 	= '';
	

	public function __construct ($response)
	{
		$this->response = $response;
		$this->remoteip = $_SERVER ['REMOTE_ADDR'];
	}

	/**
     * check google captcha in diferent classes
     * 
     * @return void
     */
	public function check()
	{
		$this->send();
		$this->decode();
		$this->checkAnswer();
	}

	/**
     * set success in true or false
	 * 
	 * @param bool $val
     * 
     * @return void
     */
	public function setSuccess($val)
	{
		$this->success = $val == true ? true : false;
	}

	/**
     * set error in true if the captha is not passed
	 * 
	 * @param bool $val
     * @return void
     */
	public function setError($val)
	{
		$this->error = $val == true ? true : false;
	}

	/**
     * set error message
	 * 
	 * @param string $message
     * @return void
     */
	public function setErrorMessage($message)
	{
		$this->errorMessage = !empty ($message) ? $message : '';
	}

	/**
     * check errors
	 * 
     * @return bool
     */
	public function hasError()
	{
		return $this->error;
	}

	/**
     * get error message
	 * 
     * @return string
     */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	/**
     * send a request to the google website and get a response
	 * 
     * @return void
     */
	private function send ()
	{
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $this->url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' 	=> $this->secret,
				'response' 	=> $this->response,
				'remoteip' 	=> $this->remoteip
		   ],
		   CURLOPT_RETURNTRANSFER => true
		  ]);
	
		$this->output = curl_exec($ch);
		curl_close($ch);
	}

	/**
     * decode a response from json
	 * 
     * @return void
     */
	private function decode ()
	{
		$this->recaptcha = json_decode($this->output);
	}

	/**
     * check respond 
	 * 
     * @return void
     */
	private function checkAnswer ()
	{	
		$recaptcha = $this->recaptcha;
		if ($recaptcha->success === true && $recaptcha->score >= $this->score) {
			$this->setSuccess(true);
		} else {
			$this->setError(true);
			$this->setErrorMessage('Капча не пройдена');
		}
	}
}