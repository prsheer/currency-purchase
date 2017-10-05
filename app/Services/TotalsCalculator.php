<?php

namespace App\Services;

class TotalsCalculator
{
    /**
     * Calculate the totals.
     *
     * @param $data
     * @return mixed
     */
    public function makeTotalsCalculations($data) {
        $amountUsd = $data['amount_usd'];
        $surchangePercentage = $data['surchange_percentage'];
        $currencyPurchased = strtolower($data['currency_purshased']);
        $exchangeRatesApi = new ExchangeRatesApi();
        $exchangeRates = $exchangeRatesApi->getExchangeRates();

        $total = $amountUsd * $exchangeRates[$currencyPurchased];
        $surchange = $total * ($surchangePercentage / 100);
        $grandTotal = $total + $surchange;
        $discount = 0;

        // Apply 2% discount for euro.
        if ($currencyPurchased == "eur") {
            $discountAmount = 0.02;
            $subTotal = $total + $surchange;
            $grandTotal = $subTotal - ($subTotal * $discountAmount);
            $discount = $subTotal - $grandTotal;
        }

        $data['total'] = number_format($total, 2, '.', '');
        $data['surchange'] = number_format($surchange, 2, '.', '');
        $data['grand_total'] = number_format($grandTotal, 2, '.', '');
        $data['discount_amount'] = number_format($discount, 2, '.', '');

        return $data;
    }

}
