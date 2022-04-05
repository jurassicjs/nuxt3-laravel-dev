<?php

namespace App\Domains\Order\Repositories;

use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function getAll(): Collection
    {
        return Order::all();
    }

    public function find(int $id): Order
    {
        $order =  new Order();
        $order->id = $id;
        $order->status = OrderStatus::PENDING;
        $order->price = 1200;

        return $order;
    }

    public function delete(int $id): int
    {
        return Order::destroy($id);
    }

    public function create(array $attributes): Order
    {
        return Order::create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        return Order::whereId($id)->update($attributes);
    }
}
