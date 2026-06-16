<?php

namespace Tests\Unit;

use App\Support\CreditCalculator;
use PHPUnit\Framework\TestCase;

class CreditCalculatorTest extends TestCase
{
    public function test_it_calculates_monthly_payment_with_interest(): void
    {
        $payment = CreditCalculator::monthlyPayment(3_000_000, 20, 36, 12);

        $this->assertGreaterThan(0, $payment);
        $this->assertLessThan(100_000, $payment);
    }

    public function test_it_calculates_monthly_payment_without_interest(): void
    {
        $payment = CreditCalculator::monthlyPayment(1_200_000, 0, 12, 0);

        $this->assertSame(100_000.0, $payment);
    }
}
