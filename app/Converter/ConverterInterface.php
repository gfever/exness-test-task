<?php
/**
 * @author d.ivaschenko
 */

namespace App\Converter;


use App\Rate;

interface ConverterInterface
{
    public function convert(int $toCurrencyId, float $amount, Rate $rate): float;
}