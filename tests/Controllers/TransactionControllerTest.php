<?php
/**
 * @author d.ivaschenko
 */

namespace Tests\Controllers;


use App\Http\Controllers\TransactionController;
use App\Http\Requests\ListTransactions;
use App\Models\User;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{

    public function testIndex()
    {
        $requestMock = $this->createMock(ListTransactions::class);
        $requestMock->from_date = '2000-11-11';
        $requestMock->to_date = '2000-11-11';
        $this->instance(ListTransactions::class, $requestMock);

        $userMock = \Mockery::mock();
        $userMock->shouldReceive('where')->times(3)->andReturn($userMock);
        $userMock->shouldReceive('first')->times(1)->andReturn($userMock);
        $userMock->shouldReceive('transactions')->times(1)->andReturn($userMock);
        $userMock->shouldReceive('get')->times(1)->andReturn($userMock);

        $this->instance(User::class, $userMock);

        $result = $this->get(action([TransactionController::class, 'index']));

        $this->assertEquals(200, $result->status());
    }

}
