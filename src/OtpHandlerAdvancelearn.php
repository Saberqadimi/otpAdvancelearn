<?php

namespace Advancelearn\OtpAuth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class OtpHandlerAdvancelearn
{
    public function generateToken($data)
    {
        $userName = $this->checkUserNameField($data);
        $fieldName = isset($userName['email']) ? 'email' : 'mobile';
        return $this->tokenHandler($userName[$fieldName] , $data['time']);
    }

    /**
     * @param $user_name
     * @param $time
     * @return mixed
     */
    private function tokenHandler($user_name , $time): mixed
    {
        $cache_key = 'otp_' . $user_name;
        Cache::forget($cache_key);
        $code_random = mt_rand(1000, 9999);
        $expires_at = Carbon::now()->addMinutes($time);
        Cache::put($cache_key, $code_random, $expires_at);
        return json_decode($code_random, FALSE);
    }

    public function verify($data): \Illuminate\Http\JsonResponse
    {
        $userName = $this->checkUserNameField($data);
        $fieldName = isset($userName['email']) ? 'email' : 'mobile';
        $cacheKey = $userName[$fieldName];
        $cachedOtp = Cache::get('otp_' . $cacheKey);
        if ($cachedOtp == $data['token']) {
            Cache::forget('otp_' . $cacheKey);
            return response()->json(['success' => 'Token is verified you can register or logged in user', 'status' => true]);
        } else {
            return response()->json(['error' => 'Token is not matched', 'status' => false]);
        }
    }

    /**
     * @param $input
     * @return array
     */
    private function checkUserNameField($input): array
    {
        if (is_numeric($input['username'])) {
            $userName = ['mobile' => $input['username']];
        } else {
            $userName = ['email' => $input['username']];
        }
        return $userName;
    }

}
