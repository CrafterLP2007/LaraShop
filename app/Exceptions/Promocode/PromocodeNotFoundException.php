<?php

namespace App\Exceptions\Promocode;

use Exception;

class PromocodeNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Promocode not found or inactive.');
    }
}
