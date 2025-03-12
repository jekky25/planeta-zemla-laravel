<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class U extends AbstractBBCode
{
	protected $pattern		= '/\[u\](.*?)\[\/u\]/siu';
	protected $replacement	= '<u>\\1</u>';
}