<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class OrderPurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//
//    public function purchase(Order $order)
//    {
//        $invoice = new Invoice();
//        $invoice->amount($order->final_amount_payable);
//
//        $payment = Payment::callbackUrl(route('purchase.result', [$order->id]));
//
//        $payment->purchase($invoice, function ($driver, $transactionId){
//
//        });
//
//        return $payment->pay()->render();
//    }
//
//    public function result(Request $request, Order $order)
//    {
//        $request->dd();
//    }


    public function purchase(Order $order)
    {
        $invoice = new Invoice();
        $invoice->amount($order->final_amount_payable * 10);
//
        $payment = Payment::callbackUrl(route('purchase.result', [$order->id]));
        $payment->purchase($invoice, function ($driver, $transactionId) {
//
        });

        return self::successResponse([
            'payment_url' => $payment->pay()->render()
        ]);
    }

    public function result(Request $request, Order $order)
    {
        return self::successResponse($request->all());
    }


//    public function purchase(Order $order)
//    {
//        // ایجاد فاکتور جدید
//        $invoice = new Invoice();
//        $invoice->amount($order->final_amount_payable * 10);  // مبلغ نهایی سفارش (مضاعف شده به دلخواه)
//
//        // تنظیم callbackUrl که بعد از انجام تراکنش، نتیجه به این آدرس فرستاده شود.
//        $payment = Payment::callbackUrl(route('purchase.result', [$order->id]));
//
//        // انجام خرید
//        $payment->purchase($invoice, function ($driver, $transactionId) {
//            // می‌توانید در اینجا لاگ یا دیگر عملیات‌های مورد نیاز را انجام دهید.
//        });
//
//        // بازگشت به موفقیت و اضافه کردن authority به پاسخ
//        return self::successResponse([
//            'status' => 'ok',
//            'authority' => $payment->getAuthority()  // مقدار authority را از درایور پرداخت دریافت می‌کنیم
//        ]);
//    }
//
//    public function result(Request $request, Order $order)
//    {
//        // نمایش اطلاعاتی که از callback ارسال شده است.
//        return self::successResponse([
//            'status' => 'ok',
//            'authority' => $request->get('Authority'),  // authority ارسال شده از سمت بانک
//            'payment_data' => $request->all()  // نمایش تمام داده‌های ارسال شده
//        ]);
//    }


}
