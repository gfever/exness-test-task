<?php
/**
 * @author d.ivaschenko
 */

namespace App\Converter;


use App\Rate;

class Converter implements ConverterInterface
{

    /**
     * @param int $toCurrencyId
     * @param float $amount
     * @return float
     */
    public function convert(int $toCurrencyId, float $amount, Rate $rate): float
    {
        /** @var Rate $rate */
        $rate = resolve(Rate::class);
        $rate->where('date', '=', \DateTime);
    }

}