<?php

namespace App\Domains\Order\Dto;

use App\Domains\Order\Enums\OrderAction;
use App\Domains\Order\Enums\HttpMethod;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Link extends DataTransferObject
{
    public string $url;
    public string $method;
    public string $action;


    /**
     * @throws UnknownProperties
     */
    public static function create(string $url, HttpMethod $method, OrderAction $action): Link
    {
        return new self([
            'url' => $url,
            'method' => $method->value,
            'action' => $action->value
        ]);
    }
}
