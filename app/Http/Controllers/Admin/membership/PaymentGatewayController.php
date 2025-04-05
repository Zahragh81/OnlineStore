<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\PaymentGatewayRequest;
use App\Http\Resources\Admin\Membership\PaymentGatewayResource;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $paymentGateways = PaymentGateway::select(['id', 'title', 'merchant_id', 'terminal_id', 'secret_key', 'status'])
            ->with('logo')
            ->where(fn($q) => $q->where('title', 'like', $this->search))
            ->paginate($this->first);

        return PaymentGatewayResource::collection($paymentGateways);
    }


    public function store(PaymentGatewayRequest $request)
    {
        $paymentGateway = PaymentGateway::create($request->all());
        \Log::info($paymentGateway);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($paymentGateway->created_at)->format('Y/m/d');
            $path = "$basePath/paymentGateway/$paymentGateway->id";

            Storage::putFileAs($path, $file, $fileName);

            $paymentGateway->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'logo'
            ]);
        }

        return self::successResponse();
    }


    public function show(PaymentGateway $paymentGateway)
    {
        return new PaymentGatewayResource($paymentGateway->load('logo'));
    }


    public function update(PaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {
        $paymentGateway->update($request->all());

        if ($request->hasFile('logo')) {
            $existingLogo = $paymentGateway->logo;

            if ($existingLogo) {
                Storage::disk('public')->delete($existingLogo->path);
                $existingLogo->delete();
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($paymentGateway->created_at)->format('Y/m/d');
            $path = "$basePath/paymentGateway/$paymentGateway->id/logo";

            Storage::putFileAs($path, $file, $fileName);

            $paymentGateway->logo()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
                'type' => 'logo'
            ]);
        }

        return self::successResponse();
    }


    public function destroy(PaymentGateway $paymentGateway)
    {
        if ($paymentGateway->logo) {
            $filePath = $paymentGateway->logo->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $paymentGateway->logo()->delete();
        }

        $paymentGateway->delete();

        return self::successResponse();
    }
}
