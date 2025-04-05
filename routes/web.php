<?php
//
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
//Route::get('/', function () {
//    $invoice = new \Shetabit\Multipay\Invoice();
//    $invoice->amount(100000);
//
//    $paymentId = uniqid();
//
////    $transaction = $user->transactions()->create([
////        'payment_id' => $paymentId,
////        'order_id' => $order->id,
////        'invoice_details' => $invoice,
////        'final_amount_payable' => $invoice->getAmount()
////    ]);
//
////    $callbackUrl = route('order.result', [$order->id, 'payment_id' => $paymentId]);
//
//    return Payment::callbackUrl('http://127.0.0.1:83/verify')
//        ->config('description', "پرداخت سفارش شماره ")
//        ->purchase($invoice, function ($driver, $transactionId) {
//
//        })->pay()->toJson();
//});
//
//Route::get('/verify', function (Request $request) {
//    dd($request->all);
//});
