<?php
declare(strict_types=1);

namespace App\Modules\BBCode;

interface BBCodeInterface
{
    /**
     * Replace BBCode in the string
     *
     * @return string
     */
    public function replace() :string;

}
