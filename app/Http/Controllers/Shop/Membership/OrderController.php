<?php

namespace App\Http\Controllers\Shop\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\Membership\OrderChangeStatusRequest;
use App\Http\Requests\Shop\Membership\OrderRequest;
use App\Http\Requests\Shop\Membership\VerifyPaymentRequest;
use App\Http\Resources\Admin\Membership\CourierResource;
use App\Http\Resources\Shop\Membership\OrderItemResource;
use App\Http\Resources\Shop\Membership\OrderResource;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderItemStatus;
use App\Models\OrderStatus;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $paymentGateway;

    public function __construct(PaymentGatewayService $paymentGateway, Request $request)
    {
        parent::__construct($request);

        $this->paymentGateway = $paymentGateway;
    }

    public function index(Request $request)
    {
        $storeId = $request->input('store_id');

        $orders = Order::select(['id', 'final_amount_payable', 'first_name', 'last_name', 'status', 'shipping_method_id', 'order_status_id', 'created_at'])
            ->with(['shippingMethod:id,title', 'orderStatus:id,name'])
            ->whereHas('orderItems', fn($q) => $q->whereHas('productBalance', fn($q) => $q->where('store_id', $storeId)))
            ->where(fn($q) => $q->where('first_name', 'like', $this->search)
                ->orWhere('last_name', 'like', $this->search))
            ->whereIn('order_status_id', [1, 2])
            ->paginate($this->first);

        return OrderResource::collection($orders);
    }


    public function orderArchive(Request $request)
    {
        $storeId = $request->input('store_id');

        $orders = Order::select(['id', 'final_amount_payable', 'first_name', 'last_name', 'status', 'shipping_method_id', 'order_status_id', 'created_at'])
            ->with(['shippingMethod:id,title', 'orderStatus:id,name'])
            ->whereHas('orderItems', fn($q) => $q->whereHas('productBalance', fn($q) => $q->where('store_id', $storeId)))
            ->where(fn($q) => $q->where('first_name', 'like', $this->search)
                ->orWhere('last_name', 'like', $this->search))
            ->whereIn('order_status_id', [3, 4])
            ->paginate($this->first);

        return OrderResource::collection($orders);
    }


    public function show(Order $order)
    {
        $order = $order->load([
            'user:id,first_name,last_name',
            'shippingMethod:id,title',
            'province:id,name',
            'city:id,name',
            'orderStatus:id,name',
            'courier' => fn($q) => $q->with([
                'user:id,first_name,last_name,username,mobile',
                'courierType:id,name',
            ]),
            'orderItems' => fn($q) => $q->with([
                'productBalance' => fn($q) => $q->with([
                    'product' => fn($q) => $q->with([
                        'productNature' => fn($q) => $q->with([
                            'storeType' => fn($q) => $q->with('productGroupTypes')
                        ])
                    ]),
                    'productBalanceAttributes',
                ]),
                'orderItemStatus'
            ]),
        ]);


        return self::successResponse([
            'order' => new OrderResource($order),
            'orderItems' => OrderItemResource::collection($order->orderItems)
        ]);
    }


    public function update(OrderRequest $request, Order $order)
    {
        $input = $request->all();

        $order->update($input);

        return self::successResponse();

    }


    public function orderChangeStatus(OrderChangeStatusRequest $request, Order $order)
    {
        $newOrderStatusId = $request->input('order_status_id');

        $order->order_status_id = $newOrderStatusId;

        $order->save();

        return self::successResponse();
    }


    public function courier()
    {
        $couriers = Courier::select(['id', 'user_id'])
            ->with(['user:id,first_name,last_name,username,mobile'])
            ->get();

        return CourierResource::collection($couriers);
    }


    public function upsertData()
    {
        return self::successResponse([
            'orderStatuses' => OrderStatus::select(['id', 'name'])->get(),
            'orderItemStatuses' => OrderItemStatus::select(['id', 'name'])->get()
        ]);
    }


    public function result(VerifyPaymentRequest $request, Order $order)
    {
        $input = $request->all();
        \Log::info($input);
        $paymentId = $request->payment_id;
        $authority = $request->authority;

        return $this->paymentGateway->verifyPayment($order, $paymentId, $authority);
    }

}
