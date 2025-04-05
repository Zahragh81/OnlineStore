<?php

namespace App\Http\Controllers\Shop\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\Membership\OrderItemChangeStatusRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function __invoke(OrderItemChangeStatusRequest $request, Order $order)
    {
        $orderItemStatus = $request->input('order_item_status_id');
        $orderItems = $request->input('order_items_id');

        foreach ($orderItems as $orderItemId) {
            $orderItem = $order->orderItems()->find($orderItemId);
            $orderItem->order_item_status_id = $orderItemStatus;
            $orderItem->save();
        }

        return self::successResponse();
    }
}
