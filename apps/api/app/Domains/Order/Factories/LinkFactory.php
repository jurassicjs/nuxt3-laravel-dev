<?php

namespace App\Domains\Order\Factories;

use App\Domains\Order\Dto\Link;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Enums\HttpMethod;
use App\Domains\Order\Enums\OrderAction;
use App\Domains\Order\Enums\OrderStatus;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LinkFactory
{

    /**
     * @throws UnknownProperties
     */
    public function attachLinks(Order $order): Order
    {
        $apiBaseUrl = env('API_BASE_URL');
        $payUrl = "$apiBaseUrl/order/$order->id/pay";
        $cancelUrl = "$apiBaseUrl/order/$order->id/cancel";
        $rebateUrl = "$apiBaseUrl/order/$order->id/rebate";
        $method = HttpMethod::POST;

        $isManager = true;

        if ($order->status !== OrderStatus::CANCELED){
            $order->actionLinks['cancelLink'] = Link::create($cancelUrl, $method, OrderAction::CANCEL);
        }

        if ($isManager){
            $order = $this->addManagerRestrictedLinks($rebateUrl, $method, $order);
        }

        if ($order->status === OrderStatus::PENDING) {
            $order->actionLinks['payLink'] = Link::create($payUrl, $method, OrderAction::PAY);
        }

        return $order;
    }

    private function addManagerRestrictedLinks(string $rebateUrl, HttpMethod $method, Order $order): Order
    {
        if ($order->status === OrderStatus::COMPLETE) {
            $order->actionLinks['rebateLink'] = Link::create($rebateUrl, $method, OrderAction::REBATE);
        }

        if ($order->status !== OrderStatus::CANCELED) {
            $order->actionLinks['revokeCancellationLink'] = Link::create($rebateUrl, $method, OrderAction::REBATE);
        }

        return $order;
    }
}
