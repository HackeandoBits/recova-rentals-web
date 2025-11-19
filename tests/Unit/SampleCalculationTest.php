<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SampleCalculationTest extends TestCase
{
    public function test_total_price_with_quantity()
    {
        $unitPrice = 1000;
        $quantity = 3;

        $total = $unitPrice * $quantity;

        $this->assertEquals(3000, $total);
    }
}
