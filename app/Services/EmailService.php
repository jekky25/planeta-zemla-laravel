<?

namespace App\Services;

class EmailService
{
	/**
	 * sends emails over Email helper
	 * 
	 * @param array $params
	 * @param string $templateName
	 * @return void
	 */
	public function send($params, $class)
	{
		$params['to'] = config('app.admin_email');
		dispatch(new $class($params));
		if (!empty($params['copy'])) {
			$params['to'] = $params['email'];
			dispatch(new $class($params));
		}
		
	}
}
