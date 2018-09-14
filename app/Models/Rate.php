<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Rate
 * @package App
 *
 * @property $created_at
 * @property array $rates
 */
class Rate extends Model
{
    public $timestamps = false;
    public function getFreshRates()
    {
        return \file_get_contents('https://frankfurter.app/latest?base=' . config('currencies.base_currency'));
    }

    public function setFreshRates(): void
    {
        $this->rates = $this->getFreshRates();
    }

    public function setTodayTimestamp(): void
    {
        $this->created_at = $this->getTodayTimestamp();
    }

    /**
     * @return string
     */
    public function getTodayTimestamp(): string
    {
        return (new \DateTime())->format('Y-m-d');
    }

    public function getTodayRates()
    {
        $rates = \Cache::get('today_rates3');
        if (empty($rates)) {
            $rates = json_decode($this->where('created_at', '=', $this->getTodayTimestamp())->firstOrFail()->rates, true);
            $rates['rates'][config('currencies.base_currency')] = 1.0;

            array_walk($rates['rates'], function (&$v, $k) {
                $v = (float)$v;
            });
            \Cache::put('today_rates3', $rates, 24*60);
        }

        return $rates;
    }
}
