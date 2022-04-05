<?php

namespace App\Domains\Order\Http\Controllers;

use App\Domains\Order\Services\OrderService;
use App\Http\Controllers\Controller;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientBossOrderController extends Controller
{

    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $orderId = $request->id;
            if ($orderId === null) {
                throw new InvalidArgumentException('id missing in request');
            }
            if (!is_numeric($orderId)) {
                throw new InvalidArgumentException('invalid id type. order id must be numeric');
            }
            $order = $this->orderService->find($orderId);
            return response()->json($order);
        } catch (InvalidArgumentException $e) {
            return response()->json($e->getMessage(), 400);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json('server error', 500);
        }
    }
}
