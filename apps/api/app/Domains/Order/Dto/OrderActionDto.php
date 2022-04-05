<?php

namespace App\Domains\Order\Dto;

use App\Domains\Order\Enums\OrderAction;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class OrderActionDto extends DataTransferObject
{
    public int $orderId;
    public OrderAction $action;

    /**
     * @throws UnknownProperties
     */
    public static function create(int $orderId, OrderAction $action): OrderActionDto
    {
        return new self([
            'orderId' => $orderId,
            'action' => $action
        ]);
    }
}
