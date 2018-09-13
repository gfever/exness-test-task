<?php
/**
 * @author d.ivaschenko
 */

namespace App\Converter;


use App\Rate;
use Illuminate\Database\Eloquent\Collection;

class Converter
{
    private $rates;
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
            /** @var Collection $result */
            $result = $rate->where('created_at', '=', $this->timestamp)->pluck("rates.rates.$currencyCodeIn as $currencyCodeIn",
                "rates.rates.$currencyCodeOut as $currencyCodeOut");
            if ($result->count() === 0) {
                \Log::error("No exchange rates on this date {$this->timestamp}");
                throw new \Exception("No exchange rates on this date {$this->timestamp}");
            }
            $this->rates = $result->first();
        }

        return $this->rates;
    }

    /**
     * @param string $currencyCode
     * @param $amount
     * @return float|int
     * @throws \Exception
     */
    public function convertFromBase(string $currencyCode, $amount)
    {
        return $this->rates[$currencyCode]*$amount;
    }

    /**
     * @param string $currencyCode
     * @param $amount
     * @return float|int
     * @throws \Exception
     */
    public function convertToBase(string $currencyCode, float $amount)
    {
        return $this->rates[$currencyCode]/$amount;
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