<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

use App\Models\CustomBBCode as ModelBBCode;

class CustomBBCode extends AbstractBBCode
{
	protected static $codes = null;

	public function __construct($str)
	{
		parent::__construct($str);
		if (self::$codes === null)
		{
			self::$codes = ModelBBCode::all();
		}
	}

	/**
     * Replace BBCode in the string
     *
     * @return string
     */
	public function replace() :string
	{
		$k = 0;
		foreach(self::$codes as $code) {
			if ($k > 0) break;
			$k++;
			$this->strReplace	= preg_replace($code->patternModify, $code->replacement_html, $this->strReplace);
		}		

		return $this->strReplace;
	}
}