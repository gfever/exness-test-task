<?php
/**
 * @author d.ivaschenko
 */

namespace Tests\Controllers;


use App\Facades\TransferFacade;
use App\Http\Controllers\TransferController;
use App\Http\Requests\StoreTransfer;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\User;
use Tests\TestCase;

class TransferControllerTest extends TestCase
{

    public function testStore()
    {
        $requestMock = $this->createMock(StoreTransfer::class);
        $requestMock->expects($this->once())->method('except')->willReturn([]);
        $requestMock->currency_code = 'EUR';
        $requestMock->sender_password = 'secret';
        $this->instance(StoreTransfer::class, $requestMock);

        $userMock = \Mockery::mock();
        $userMock->shouldReceive('find')->times(2)->andReturn($userMock);
        $userMock->currency = new class()
        {
            public $code = 'EUR';
        };
        $userMock->password = 'secret';
        $this->instance(User::class, $userMock);

        $currencyMock = \Mockery::mock();
        $currencyMock->shouldReceive('whereCode')->andReturn($currencyMock);
        $currencyMock->shouldReceive('firstOrFail')->andReturn($currencyMock);
        $currencyMock->id = 1;
        $this->instance(Currency::class, $currencyMock);

        $transferMock = $this->createMock(Transfer::class);
        $transferMock->expects($this->once())->method('fill');
        $transferMock->expects($this->once())->method('save');
        $this->instance(Transfer::class, $transferMock);

        $transferFacadeMock = $this->createMock(TransferFacade::class);
        $transferFacadeMock->expects($this->once())->method('setTransfer')->with($transferMock);
        $transferFacadeMock->expects($this->once())->method('process');
        $this->instance(TransferFacade::class, $transferFacadeMock);

        $result = $this->post(action([TransferController::class, 'store']));
        $this->assertEquals(200, $result->status());
    }

}
