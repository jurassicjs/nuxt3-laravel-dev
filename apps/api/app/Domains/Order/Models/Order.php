<?php

namespace App\Domains\Order\Models;

use App\Domains\Order\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

/**
* @property int $id
* @property OrderStatus $status
* @property int $price
* @property ?string cancelLink
* @property array $arrayLinks
*/
class Order extends Model
{
    public array $actionLinks = [];

}
