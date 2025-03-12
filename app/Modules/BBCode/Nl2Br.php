<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class Nl2Br extends AbstractBBCode
{
	protected $pattern		= '';
	protected $replacement	= '';

	public function replace() :string
	{
		$this->strReplace	= preg_replace(['/\r/', '/^\n+/', '/\n+$/'], '', $this->strReplace);
		$this->strReplace	= str_replace("\n", '<br />', $this->strReplace);
		return $this->strReplace;
	}
}
