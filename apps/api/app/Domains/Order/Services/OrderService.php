<?php

namespace App\Domains\Order\Services;

use App\Domains\Order\Enums\OrderAction;
use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Factories\LinkFactory;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private LinkFactory $linkFactory;

    public function __construct(OrderRepository $orderRepository, LinkFactory $linkFactory)
    {
        $this->orderRepository = $orderRepository;
        $this->linkFactory = $linkFactory;
    }

    public function find(int $orderId): Order
    {
        return $this->orderRepository->find($orderId);
    }

    public function processAction(int $orderId, OrderAction $action): Order
    {
        $updatedStatus = $this->updateStatus($action);
        $order =  $this->orderRepository->find($orderId);
        $order->status = $updatedStatus;

        return $this->linkFactory->attachLinks($order);
    }

    private function updateStatus(OrderAction $action): OrderStatus
    {
        if ($action === OrderAction::PAY) {
            return OrderStatus::COMPLETE;
        }

        if ($action === OrderAction::CANCEL) {
            return OrderStatus::CANCELED;
        }

        if ($action === OrderAction::REBATE) {
            return OrderStatus::REBATED;
        }

        return OrderStatus::PENDING;
    }
}
