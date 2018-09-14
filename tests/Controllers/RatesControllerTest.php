<?php
/**
 * @author d.ivaschenko
 */

namespace Tests\Controllers;


use App\Http\Controllers\RateController;
use App\Rate;
use Tests\TestCase;

class RatesControllerTest extends TestCase
{

    public function testUpdate()
    {
        /** @see RateController::store() */
        $response = $this->post(action([RateController::class, 'store']));
        $rateMock = $this->createMock(Rate::class);
        $rateMock->expects($this->once())->method('setFreshRates');
        $rateMock->expects($this->once())->method('setTodayTimestamp');
        $rateMock->expects($this->once())->method('save');

        $this->assertEquals(200, $response->status());
    }
}