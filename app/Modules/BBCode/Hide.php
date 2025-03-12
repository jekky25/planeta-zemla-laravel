<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class Hide extends AbstractBBCode
{
	protected $pattern		= '/\[hide\](.*?)\[\/hide\]/siu';
	protected $replacement	= '\\1';
}