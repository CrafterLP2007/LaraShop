<?php

namespace App\Enums;

enum PromocodeType: string
{
    case PERCENTAGE = 'percentage';
    case FIXED = 'fixed';
}
