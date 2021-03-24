<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use Tests\TestCase;
use App\Services\User\UserServices;
use App\Exceptions\BusinessException;
use Illuminate\Bus\BusServiceProvider;

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
            $isPass = UserServices::getInstance()->checkMobileSendCaptchaCount($mobile);
            $this->assertTrue($isPass);
        }
        $isPass = UserServices::getInstance()->checkMobileSendCaptchaCount($mobile);
        $this->assertFalse($isPass);
    }

    public function testCheckCaptcha()
    {
        $mobile = '18534567871';
        $code = UserServices::getInstance()->setCaptcha($mobile);
        $isPass = UserServices::getInstance()->checkCaptcha($mobile, $code);
        $this->asserTrue($isPass);

        $this->expectExceptionObject(new BusinessException());
        UserServices::getInstance()->checkCaptcha($mobile, $code);
    }
}
