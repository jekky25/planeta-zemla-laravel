<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class AbstractBBCode implements BBCodeInterface
{
	protected $pattern		= null;
	protected $replacement	= null;
	protected $strReplace	= '';

	public function __construct($str)
	{
		$this->strReplace = $str;
	}

	/**
     * Replace BBCode in the string
     *
     * @return string
     */
	public function replace() :string
    {
		if ($this->pattern === null || $this->replacement === null) return $this->strReplace;
		$this->strReplace = preg_replace($this->pattern, $this->replacement, $this->strReplace);
		return $this->strReplace;
    }
}
