<?php
/**
 * @author d.ivaschenko
 */

namespace Tests;


use App\Converter\Converter;

class ConverterTest extends TestCase
{

    public function testConvert()
    {
        /** @var Converter $converter */
        $converter = resolve(Converter::class);
        $converter->rates = [
            'EUR' => 1.2,
            'USD' => 1,
        ];

        $amountFromBase = $converter->convertFromBase('EUR', 10);
        $amountToBase = $converter->convertToBase('EUR', 10);

        $this->assertEquals(12.0, $amountFromBase);
        $this->assertEquals(8.33, $amountToBase);
    }

}