<?php

namespace App\Domains\Order\Enums;

enum OrderStatus: string
{
   case PENDING = 'pending';
   case PROCESSING = 'processing';
   case REBATED = 'rebated';
   case COMPLETE = 'complete';
   case ABANDONED = 'abandoned';
   case CANCELED = 'canceled';
}
