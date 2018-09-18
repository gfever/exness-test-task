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

    public function setFreshRates(): void
    {
        $this->rates = $this->getFreshRates();
    }

    /**
     * @param int $attempts
     * @return bool|string
     * @throws \Exception
     */
    public function getFreshRates(int $attempts = 10)
    {
        for ($i = 0; $i < $attempts; $i++) {
            try {
                return \file_get_contents('https://frankfurter.app/latest?base=' . config('currencies.base_currency'));
            } catch (\Exception $exception) {
                usleep(100);
            }
        }

        throw new \Exception('Can\'t load rates!');
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

    public function getTodayRates(): array
    {
        $rates = \Cache::get($this->getTodayTimestamp());
        if (empty($rates)) {
            $rates = $this->where('created_at', '=', $this->getTodayTimestamp())->first();

            if (!$rates) {
                throw new \Exception('Today rates not loaded!!!');
            }

            $rates = json_decode($rates->rates, true);
            $rates['rates'][config('currencies.base_currency')] = 1.0;

            array_walk($rates['rates'], function (&$v) {
                $v = (float)$v;
            });

            \Cache::put($this->getTodayTimestamp(), $rates, 24 * 60);
        }

        return $rates;
    }

}
