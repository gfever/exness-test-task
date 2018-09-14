<?php
/**
 * @author d.ivaschenko
 */

namespace Tests\Controllers;


use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUser;
use App\Models\Currency;
use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testStore()
    {
        $currencyMock = \Mockery::mock();
        $currencyMock->shouldReceive('where')->times(1)->andReturn($currencyMock);
        $currencyMock->shouldReceive('firstOrFail')->times(1)->andReturn($currencyMock);
        $currencyMock->id = 1;
        $this->instance(Currency::class, $currencyMock);

        $requestMock = $this->createMock(StoreUser::class);
        $requestMock->expects($this->once())->method('except')->willReturn([]);
        $this->instance(StoreUser::class, $requestMock);

        $userMock = $this->createMock(User::class);
        $userMock->expects($this->once())->method('fill');
        $userMock->expects($this->once())->method('save');
        $this->instance(User::class, $userMock);

        $result = $this->post(action([UserController::class, 'store']));
        $this->assertEquals(200, $result->status());
    }

}
