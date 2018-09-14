<?php
/**
 * @author d.ivaschenko
 */

namespace App\Http\Controllers;

use App\Models\Rate;

class RateController extends Controller
{

    public function store()
    {
        /** @var Rate $rate */
        $rate = resolve(Rate::class);
        $rate->setFreshRates();
        $rate->setTodayTimestamp();
        try {
            $rate->save();
            $rate->getTodayRates();
        } catch (\Exception $exception) {
            if ($exception->getCode() == 23000) {
                return response('Rates already loaded');
            }
            return response($exception->getMessage(), 400);
        }

        return response('Rates loaded');
    }
    
}