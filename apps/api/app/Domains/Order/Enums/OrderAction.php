<?php

namespace App\Domains\Order\Enums;

enum OrderAction: string
{
    case PAY = 'pay';
    case FIND = 'find';
    case CANCEL = 'cancel';
    case REBATE = 'rebate';
}
