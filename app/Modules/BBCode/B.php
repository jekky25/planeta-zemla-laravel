<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class B extends AbstractBBCode
{
	protected $pattern		= '/\[b\](.*?)\[\/b\]/siu';
	protected $replacement	= '<b>\\1</b>';
}
