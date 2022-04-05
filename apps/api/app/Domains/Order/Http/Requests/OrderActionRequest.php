<?php

namespace App\Domains\Order\Http\Requests;

use Illuminate\Http\Request;
use App\Domains\Order\Enums\OrderAction;
use App\Domains\Order\Dto\OrderActionDto;
use App\Domains\Order\Exceptions\InvalidRequestException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class OrderActionRequest
{
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @throws InvalidRequestException|UnknownProperties
     */
    public function validated(): OrderActionDto
    {
        $orderId = $this->request->id;
        $action = $this->request->action;
        $orderAction = OrderAction::tryFrom($action);

        if ($orderAction === null) {
            InvalidRequestException::wrongActionType($action, 'OrderAction');
        }

        if ($orderId === null) {
            InvalidRequestException::missingArgument('id');
        }

        if (!is_numeric($orderId)) {
            InvalidRequestException::wrongArgumentType('id', 'numeric');
        }

        return OrderActionDto::create($orderId, $orderAction);
    }
}
