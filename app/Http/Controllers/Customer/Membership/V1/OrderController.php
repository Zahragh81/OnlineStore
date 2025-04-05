<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Membership\V1\OrderRequest;
use App\Http\Resources\Customer\Membership\V1\OrderItemResource as CustomerOrderItemResource;
use App\Http\Resources\Customer\Membership\V1\PaymentGatewayResource as CustomerPaymentGatewayResource;
use App\Http\Resources\Customer\Membership\V1\OrderResource as CustomerOrderResource;
use App\Http\Resources\Customer\Membership\V1\CityResource as CustomerCityResource;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemStatus;
use App\Models\OrderStatus;
use App\Models\PaymentGateway;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\ShippingMethod;
use App\Models\ShoppingCart;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $paymentGateway;

    public function __construct(PaymentGatewayService $paymentGateway, Request $request)
    {
        parent::__construct($request);

        $this->paymentGateway = $paymentGateway;
    }

    public function index()
    {
        $orders = Order::select(['id', 'final_amount_payable', 'order_status_id', 'created_at', 'status'])
            ->with('orderStatus')
            ->where('pay_status', true)
            ->paginate($this->first);

        return CustomerOrderResource::collection($orders);
    }


    public function store(OrderRequest $request, PaymentGatewayService $paymentGatewayService)
    {
        $userId = Auth::id();
        $user = Auth::user();

        $order = Order::create([
            'shipping_cost' => $request->shipping_cost,
            'discount' => $request->discount,
            'final_amount_payable' => $request->final_amount_payable,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'user_id' => $userId,
            'shipping_method_id' => $request->shipping_method_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'payment_gateway_id' => $request->payment_gateway_id,
            'payment_method_id' => $request->payment_method_id
        ]);

        foreach ($request->order_items as $item) {
            OrderItem::create([
                'number' => $item['number'],
                'per_unit' => $item['per_unit'],
                'total_amount' => $item['total_amount'],
                'order_id' => $order->id,
                'product_balance_id' => $item['product_balance_id'],
            ]);
        }

        ShoppingCart::where('user_id', $userId)->delete();

        $paymentLink = $this->paymentGateway->initiatePayment($order, $user);

        $paymentLink = json_decode($paymentLink, true);
        $paymentLink['action'] = str_replace("\\/", "/", $paymentLink['action']);

        return self::successResponse([
            'payment_link' => $paymentLink['action']
        ]);
    }


    public function show(Order $order)
    {
        $order = $order->load([
            'shippingMethod',
            'orderStatus',
            'courier' => fn($q) => $q->with([
                'user:id,first_name,last_name,username,mobile',
                'courierType:id,name',
            ]),
            'orderItems' => fn($q) => $q->with([
                'productBalance' => fn($q) => $q->with([
                    'product' => fn($q) => $q->select(['id', 'name'])->with(['files'])
                ]),
                'orderItemStatus',
            ])
        ]);

        return self::successResponse([
            'order' => new CustomerOrderResource($order),
            'orderItems' => CustomerOrderItemResource::collection($order->orderItems)
        ]);
    }


    public function city(Request $request)
    {
        $provinceId = $request->input('province_id');

        Province::find($provinceId);

        $cities = City::where('parent_id', $provinceId)->get();

        return CustomerCityResource::collection($cities);
    }


    public function upsertData()
    {
        return self::successResponse([
            'PaymentGateways' => CustomerPaymentGatewayResource::collection(PaymentGateway::select(['id', 'title'])->with(['logo'])->get()),
            'shippingMethods' => ShippingMethod::select(['id', 'title', 'price'])->get(),
            'provinces' => Province::select(['id', 'name'])->get(),
            'orderStatuses' => OrderStatus::select(['id', 'name'])->get(),
            'orderItemStatuses' => OrderItemStatus::select(['id', 'name'])->get(),
            'paymentMethods' => PaymentMethod::select(['id', 'name'])->get(),
        ]);
    }
}
