<?php
declare(strict_types=1);

namespace App\Traits;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasFilter
 *
 * @method static Builder filter(Filter $filter)
 */
trait HasPrepareText
{
	private $patterns		= [];
	private $replacements	= [];
	private $strReplace		= '';

	/**
	 * Replaces newlines with HTML line breaks
	 * @return object
	 */
	public function nl2br()
	{
		$this->strReplace	= preg_replace(array('/\r/', '/^\n+/', '/\n+$/'), '', $this->strReplace);
		$this->strReplace	= str_replace("\n", '<br />', $this->strReplace);
		return $this;
	}

	/**
	 * Set start params for preparation
	 * @param  string $str
	 * @return object
	 */
	private function setParams($str) {
		$this->strReplace = $str;

		// B
		$this->patterns[]		= '/\[b\](.*?)\[\/b\]/iu';
		$this->replacements[]	= '<b>\\1</b>';

		// I
		$this->patterns[]		= '/\[i\](.*?)\[\/i\]/iu';
		$this->replacements[]	= '<i>\\1</i>';

		// U
		$this->patterns[]		= '/\[u\](.*?)\[\/u\]/iu';
		$this->replacements[]	= '<u>\\1</u>';

		// S
		$this->patterns[]		= '/\[s\](.*?)\[\/s\]/iu';
		$this->replacements[]	= '<strike>\\1</strike>';

		// SUP
		$this->patterns[]		= '/\[sup\](.*?)\[\/sup\]/iu';
		$this->replacements[]	= '<sup>\\1</sup>';

		// SUB
		$this->patterns[]		= '/\[sub\](.*?)\[\/sub\]/iu';
		$this->replacements[]	= '<sub>\\1</sub>';

		// HIDE
		$this->patterns[]		= '/\[hide\](.*?)\[\/hide\]/iu';
		$this->replacements[]	= '\\1';

		return $this;
	}

	/**
	 * Replaces Quote BBCODES
	 * 
	 * @return string
	 */
	private function quoteReplace()
	{
		$quotePattern = '#\[quote[^\]]*?\](<br\s?\/?\>)*([^\[]+)(<br\s?\/?\>)*\[\/quote\]#iu';
		$quoteReplace = '<span class="quote">' . '\\1' . '</span><blockquote>\\2</blockquote>';
		while(preg_match($quotePattern, $this->strReplace)) {
			$this->strReplace = preg_replace($quotePattern, $quoteReplace, $this->strReplace);
		}
		return $this;
	}

	/**
	 * Replaces simple BBCODES
	 * 
	 * @return object
	 */
	private function simpleReplace()
	{
		$this->strReplace = preg_replace($this->patterns, $this->replacements, $this->strReplace);
		return $this;
	}

	/**
	 * Replaces BBCODES
	 * @param  string $text
	 * @return string
	 */
	public function replace($str) {
		$this->setParams($str)->nl2br()->simpleReplace()->quoteReplace();
		$str = $this->strReplace;
		$str = preg_replace('#\[\/?(b|i|u|s|sup|sub|url|img|list|quote|code|hide)\]#u', '', $str);
		return $str;
	}
}