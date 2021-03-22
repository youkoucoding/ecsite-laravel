<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use Tests\TestCase;
use App\Services\UserServices;

class Authtest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCheckMobileSendCaptchaCount()
    {
        $mobile = '13012341243';
        foreach (range(0, 9) as $i) {
            $isPass = (new UserServices())->checkMobileSendCaptchaCount($mobile);
            $this->assertTrue($isPass);
        }
        $isPass = (new UserServices())->checkMobileSendCaptchaCount($mobile);
        $this->assertFalse($isPass);
    }
}
