<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class I extends AbstractBBCode
{
	protected $pattern		= '/\[i\](.*?)\[\/i\]/siu';
	protected $replacement	= '<i>\\1</i>';
}