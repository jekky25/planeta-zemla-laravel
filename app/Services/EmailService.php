<?

namespace App\Services;

use App\Helpers\Email;

class EmailService
{
	private $params = [];

	/**
	 * sends emails over Email helper
	 * 
	 * @param array $params
	 * @param string $templateName
	 * @return void
	 */
	public function send($params, $templateName)
	{
		$this->params['NAME']		= $params['name'];
		$this->params['EMAIL']		= $params['email'];
		$this->params['SUBJECT']	= $params['subject'];
		$this->params['TEXT']		= $params['message'];

		Email::send($templateName, 'jekky25@list.ru', $this->params, 'Сообщение через обратную связь www.planeta-zemla.ru');
		if (Email::isSendCopy($params['email_copy'])) {
			Email::send($templateName, $params['email'], $this->params, 'Сообщение через обратную связь www.planeta-zemla.ru');
		}
	}
}
