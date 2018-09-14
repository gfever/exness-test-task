<?php
/**
 * @author d.ivaschenko
 */

namespace Tests;


use App\Converter\Converter;

class ConverterTest extends TestCase
{

    public function testConvertToFrom()
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

    public function testConvert()
    {
        $converter = $this->getMockBuilder(Converter::class)->setMethods(['getRatesToDate'])->getMock();
        $converter->expects($this->once())->method('getRatesToDate')->willReturn([
            'EUR' => 2,
            'GBP' => 3,
            'USD' => 1.0,
        ]);

        $result = $converter->convertFromTo('EUR', 'GBP', 10);

        $this->assertEquals(8.90, $result);
    }

}