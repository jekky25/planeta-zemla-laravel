<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class Sub extends AbstractBBCode
{
	protected $pattern		= '/\[sub\](.*?)\[\/sub\]/siu';
	protected $replacement	= '<sub>\\1</sub>';
}