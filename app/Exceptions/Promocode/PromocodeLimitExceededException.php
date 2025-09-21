<?php

namespace App\Exceptions\Promocode;

use Exception;

class PromocodeLimitExceededException extends Exception
{
    public function __construct(string $promocode)
    {
        parent::__construct("Usage limit for promocode $promocode exceeded.");
    }
}
