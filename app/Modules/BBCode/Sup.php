<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

class Sup extends AbstractBBCode
{
	protected $pattern		= '/\[sup\](.*?)\[\/sup\]/siu';
	protected $replacement	= '<sup>\\1</sup>';
}