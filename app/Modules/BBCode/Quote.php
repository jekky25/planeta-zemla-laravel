<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class Quote extends AbstractBBCode
{
	protected $pattern		= '#\[quote[^\]]*?\](<br\s?\/?\>)*([^\[]+)(<br\s?\/?\>)*\[\/quote\]#siu';
	protected $replacement	= '<span class="quote">' . '\\1' . '</span><blockquote>\\2</blockquote>';

	/**
     * Replace BBCode in the string
     *
     * @return string
     */
	public function replace() :string
	{
		while(preg_match($this->pattern, $this->strReplace)) {
			$this->strReplace = preg_replace($this->pattern, $this->replacement, $this->strReplace);
		}
		return $this->strReplace;
	}
}