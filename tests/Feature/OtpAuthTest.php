<?php

namespace Advancelearn\OtpAuth\Tests\Feature;

use Advancelearn\OtpAuth\OtpHandlerAdvancelearn;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class OtpAuthTest extends \Orchestra\Testbench\TestCase
{

    /**
     * Test generating an OTP token.
     */
    public function test_Generate_Token()
    {
        $data = [
            'username' => 'user@example.com',
            'time' => 5,
        ];
        $otpHandler = new OtpHandlerAdvancelearn();
        $token = $otpHandler->generateToken($data);
        $this->assertNotNull($token);
    }

    public function test_Token_Verification_Error()
    {
        $data = [
            'token' => mt_rand(1000, 9999),
            'username' => 'user@example.com',
        ];

        Cache::shouldReceive('get')->andReturn('valid_token');
        Cache::shouldReceive('forget');
        $verificationService = new OtpHandlerAdvancelearn();
        $result = $verificationService->verify($data);

        $this->assertEquals(['error' => $result['error'], 'status' => $result['status']], $result);
    }


}
