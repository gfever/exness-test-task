<?php
/**
 * @author d.ivaschenko
 */

namespace Tests\Controllers;


use App\Http\Controllers\RateController;
use Tests\TestCase;

class RatesControllerTest extends TestCase
{
    public function testUpdate()
    {
        $this->get(action('RatesController@upadte'));
    }
}