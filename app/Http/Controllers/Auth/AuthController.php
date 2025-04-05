<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Http\Requests\Auth\VerifyCodeRequest;
use App\Jobs\SendSmsJob;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Web
    public function sendCodeWeb(SendCodeRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();

        $store = $user->stores()->first();

        if (!$store) {
            return self::errorResponse('کاربر وجود ندارد یا فروشگاه مربوط به کاربر پیدا نشد.');
        }

        $token = Str::random(32);
        $code = rand(100000, 999999);

        Otp::create([
            'token' => $token,
            'code' => $code,
            'user_id' => $user->id
        ]);

        SendSmsJob::dispatch($request->mobile, $code);

        return self::successResponse([
            'tempToken' => $token
        ]);
    }


    public function verifyCodeWeb(VerifyCodeRequest $request)
    {
        $otp = Otp::where('used', false)
            ->where('token', $request->token)
            ->where('created_at', '>', now()->subMinutes(2))
            ->first();

        if (!$otp || $otp->code != $request->code)
            return self::errorResponse('کد تایید منقضی شده یا صحیح نیست.');

        $otp->update(['used' => true]);

        $token = $otp->user->createToken('api', expiresAt: now()->addHours(8))->plainTextToken;

        return self::successResponse([
            'token' => $token,
        ]);
    }


    public function logoutWeb()
    {
        Auth::user()->currentAccessToken()->delete();

        return self::successResponse();
    }


    // Mobile
    public function sendCodeMobile(SendCodeRequest $request)
    {
        $user = User::firstOrCreate(['mobile' => $request->mobile]);

        $token = Str::random(32);
        $code = rand(100000, 999999);

        Otp::create([
            'token' => $token,
            'code' => $code,
            'user_id' => $user->id,
        ]);

        SendSmsJob::dispatch($request->mobile, $code);


        return self::successResponse([
            'tempToken' => $token,
        ]);
    }


    public function verifyCodeMobile(VerifyCodeRequest $request)
    {
        $otp = Otp::where('used', false)
            ->where('token', $request->token)
            ->where('created_at', '>', now()->subMinutes(2))
            ->first();

        if (!$otp || $otp->code != $request->code)
            return self::errorResponse('کد تایید منقضی شده یا صحیح نیست.');

        $otp->update(['used' => true]);

        $token = $otp->user->createToken('api', expiresAt: now()->addHours(8))->plainTextToken;

        return self::successResponse([
            'token' => $token,
        ]);
    }


    public function logoutMobile()
    {
        Auth::user()->currentAccessToken()->delete();

        return self::successResponse();
    }
}
