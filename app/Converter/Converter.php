<?php
/**
 * @author d.ivaschenko
 */

namespace App\Converter;


use App\Models\Rate;
use Illuminate\Database\Eloquent\Collection;

class Converter
{
    public $rates;
    private $timestamp;



    /**
     * Converter constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->timestamp = (new \DateTime())->getTimestamp();
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @param string $currencyCodeIn
     * @param string $currencyCodeOut
     * @return array
     * @throws \Exception
     */
    private function getRatesToDate(string $currencyCodeIn, string $currencyCodeOut): array
    {
        if ($this->rates === null) {
            /** @var Rate $rate */
            $rate = resolve(Rate::class);
            $rates = $rate->getTodayRates();
            $rates = $rates['rates'];
            /** @var Collection $result */
            if (empty($rates) || empty($rates[$currencyCodeOut]) || empty($rates[$currencyCodeOut])) {
                \Log::error("No exchange rates on this date {$this->timestamp}, currencies {$rates[$currencyCodeOut]}, {$rates[$currencyCodeOut]}");
                throw new \Exception("No exchange rates on this date {$this->timestamp}, currencies {$rates[$currencyCodeOut]}, {$rates[$currencyCodeOut]}");
            }

            $this->rates[$currencyCodeOut] = $rates[$currencyCodeOut];
            $this->rates[$currencyCodeIn] = $rates[$currencyCodeIn];
            $this->rates[config('currencies.base_currency')] = 1.0;
        }

        return $this->rates;
    }

    /**
     * @param string $currencyCode
     * @param float $baseAmount
     * @return float|int
     * @throws \Exception
     */
    public function convertFromBase(string $currencyCode, float $baseAmount)
    {
        return number_format($this->rates[$currencyCode]*$baseAmount,2, '.', '');
    }

    /**
     * @param string $currencyCode
     * @param float $amount
     * @return float|int
     * @throws \Exception
     */
    public function convertToBase(string $currencyCode, float $amount)
    {
        return number_format($amount/$this->rates[$currencyCode],2, '.', '');
    }

    /**
     * @param string $currencyCodeIn
     * @param string $currencyCodeOut
     * @param $amount
     * @return float|int
     * @throws \Exception
     */
    public function convertFromTo(string $currencyCodeIn, string $currencyCodeOut, $amount)
    {
        $this->rates = $this->getRatesToDate($currencyCodeIn, $currencyCodeOut);
        return $this->convertFromBase($currencyCodeOut, $this->convertToBase($currencyCodeIn, $amount));
    }
}