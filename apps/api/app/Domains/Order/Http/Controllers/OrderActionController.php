<?php

namespace App\Domains\Order\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Order\Services\OrderService;
use App\Domains\Order\Http\Requests\OrderActionRequest;
use App\Domains\Order\Exceptions\InvalidRequestException;

class OrderActionController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function __invoke(OrderActionRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $orderId = $data->orderId;
            $action = $data->action;

            $order = $this->orderService->processAction($orderId, $action);

            return response()->json(['order' => $order, 'actionLinks' => $order->actionLinks]);
        } catch (InvalidRequestException $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'server error'], 500);
        }
    }
}
