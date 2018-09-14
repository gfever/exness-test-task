<?php
/**
 * Created by PhpStorm.
 * User: fevr
 * Date: 14.09.2018
 * Time: 23:27
 */

namespace Tests\Controllers;


use App\Http\Controllers\WalletController;
use App\Http\Requests\WalletAdd;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class WalletControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testAdd()
    {
        $userMock = $this->getMockBuilder(User::class)->setMethods(['save'])->getMock();
        $userMock->password = 'secret';
        $userMock->id = 1;
        $this->instance(User::class, $userMock);

        $requestMock = $this->createMock(WalletAdd::class);
        $requestMock->password = 'secret';
        $requestMock->amount = 1.1;
        $this->instance(WalletAdd::class, $requestMock);

        $transactionMock = $this->createMock(Transaction::class);
        $transactionMock->expects($this->once())->method('process');
        $this->instance(Transaction::class, $transactionMock);

        $result = $this->put(action([WalletController::class, 'add'], 1));
        $this->assertEquals(200, $result->status());
    }

}
