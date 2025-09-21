<?php

namespace App\Exceptions\Promocode;

use Exception;

class PromocodeNotFoundException extends Exception
{
    public function __construct(string $promocode)
    {
        parent::__construct("Promocode $promocode not found or inactive.");
    }
}
