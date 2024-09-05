<?php
namespace App\Helpers;

class Email {

	/**
	* sends emails
	* 
	* @param string $email_template
	* @param string $email
	* @param string $EMAIL
	* @param string $subject
	* @return void
	*/
	public static function sendEmail($email_template, $email, $EMAIL, $subject)
	{
		include_once('../includes/emailer.php');
	
		$emailer = new emailer(0);
		$emailer->from('<support@planeta-zemla.ru>');
		$emailer->replyto('<support@planeta-zemla.ru>');
		$emailer->email_address($email);
		$emailer->set_subject($subject);

		$GLOBALS['EMAIL'] 	= $EMAIL;

		$emailer->use_template($email_template);
		$emailer->send();
		$emailer->reset();
	}

	public static function isSendCopy($val = 0)
	{
		return ($val == 1);
	}
}
