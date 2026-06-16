<?php

namespace App\Support;

class CreditCalculator
{
    public static function monthlyPayment(float $price, float $downPaymentPercent, int $months, float $annualRate): float
    {
        if ($months <= 0) {
            return 0;
        }

        $loanAmount = $price * (1 - ($downPaymentPercent / 100));

        if ($loanAmount <= 0) {
            return 0;
        }

        if ($annualRate <= 0) {
            return $loanAmount / $months;
        }

        $monthlyRate = $annualRate / 100 / 12;
        $factor = (1 + $monthlyRate) ** $months;

        return $loanAmount * ($monthlyRate * $factor) / ($factor - 1);
    }
}
