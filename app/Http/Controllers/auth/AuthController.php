<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Jobs\SendSmsJob;
use App\Models\membership\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\ErrorHandler\Error\UndefinedFunctionError;

class AuthController extends Controller
{
    public function sendCode(SendCodeRequest $request)
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
            'tempToken' => $token
        ]);
    }


    public function verifyCode(VerifyCodeRequest $request)
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
            'token' => $token
        ]);
    }


    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return self::successResponse();
    }
}
