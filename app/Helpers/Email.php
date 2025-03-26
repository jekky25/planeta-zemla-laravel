<?php

namespace App\Helpers;

class Email
{

	/**
	 * sends emails
	 * 
	 * @param string $templateName
	 * @param string $email
	 * @param string $data
	 * @param string $subject
	 * @return void
	 */
	public static function send($templateName, $email, $data, $subject)
	{
		include_once('../includes/emailer.php');

		$emailer = new emailer(0);
		$emailer->from('<support@planeta-zemla.ru>');
		$emailer->replyto('<support@planeta-zemla.ru>');
		$emailer->email_address($email);
		$emailer->set_subject($subject);

		$GLOBALS['EMAIL'] 	= $data;

		$emailer->use_template($templateName);
		$emailer->send();
		$emailer->reset();
	}

	public static function isSendCopy($val = 0)
	{
		return ($val == 1);
	}
}
