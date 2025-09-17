<?php

namespace App\Exceptions\Promocode;

use Exception;

class PromocodeLimitExceededException extends Exception
{
    public function __construct()
    {
        parent::__construct('Promocode usage limit exceeded.');
    }
}
