<?php

namespace App\Services;

use App\Http\Resources\Shop\Membership\OrderResource;
use App\Http\Resources\Shop\Membership\TransactionResource;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Response;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentGatewayService
{
    use ApiResponse;

    public function initiatePayment(Order $order, User $user)
    {
        try {
            $invoice = new Invoice();
            $invoice->amount($order->final_amount_payable);

            $paymentId = uniqid();

            $transaction = $user->transactions()->create([
                'payment_id' => $paymentId,
                'order_id' => $order->id,
                'invoice_details' => $invoice,
                'final_amount_payable' => $invoice->getAmount()
            ]);

            $callbackUrl = 'http://192.168.1.108:3000/paymentGateway?order_id=' . $order->id . '&payment_id=' . $paymentId;


            return Payment::callbackUrl($callbackUrl)
                ->config('description', "پرداخت سفارش شماره $order->id")
                ->purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                    $transaction->update(['transaction_id' => $transactionId]);
                })->pay()->toJson();
        } catch (PurchaseFailedException $e) {
            return Response::json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }


    public function verifyPayment(Order $order, $paymentId, $authority)
    {
        $transaction = Transaction::where('payment_id', $paymentId)->first();

        if (!$transaction) {
            return self::errorResponse([
                'تراکنش نامعتبر است!'
            ]);
        }

        try {
            $result = Payment::amount($order->final_amount_payable)
                ->transactionId($authority)
                ->verify();

            $transaction->update([
                'transaction_result' => $result,
                'reference_id' => $result->getReferenceId(),
                'status' => true
            ]);

            return self::successResponse([
                'order' => new OrderResource($order),
                'transaction' => new TransactionResource($transaction)
            ]);

        } catch (InvalidPaymentException $e) {
            $transaction->update([
                'status' => false,
                'transaction_result' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return self::errorResponse([
                'message' => $e->getMessage()
            ]);
        }
    }
}
