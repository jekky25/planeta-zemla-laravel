<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class S extends AbstractBBCode
{
	protected $pattern		= '/\[s\](.*?)\[\/s\]/siu';
	protected $replacement	= '<strike>\\1</strike>';
}