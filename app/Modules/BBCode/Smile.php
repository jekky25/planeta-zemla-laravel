<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

use App\Models\CommentsSetting;

class Smile extends AbstractBBCode
{
	protected static $smiles = null;
	const URL = '../../../images/smiles/';

	public function __construct($str)
	{
		parent::__construct($str);

		if (!is_object(self::$smiles)) 
		{
			self::$smiles = $this->getCollection();
		}
	}

	/**
     * Get a colllection of smiles
     *
     * @return Illuminate\Support\Collection
     */
	public function getCollection()
	{
		$list = CommentsSetting::All()->where('name', 'smiles')->firstOrFail()->value;
		$arList = explode("\n", $list);
		$smiles = [];
		foreach ($arList as $str)
		{
			list($code, $image) = explode("\t", $str);
			$smiles[] = [
				'code'	=> $code,
				'icon'	=> self::URL . $image
			];
		}
		return collect($smiles);
	}

	/**
     * Replace BBCode in the string
     *
     * @return string
     */
	public function replace() :string
	{
		foreach (self::$smiles as $smile)
		{
			$this->strReplace	= str_replace($smile['code'], '<img class="smile" src="' . $smile['icon'] . '" alt="" />', $this->strReplace);
		}
		return $this->strReplace;
	}
}