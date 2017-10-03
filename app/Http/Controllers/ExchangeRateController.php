<?php

namespace App\Http\Controllers;

use App\Services\ExchangeRatesApi;

class ExchangeRateController extends Controller
{
    /**
     * Update exchange rates
     *
     * @param ExchangeRatesApi $exchangeRates
     */
    public function updateExchangeRates(ExchangeRatesApi $exchangeRates) {
        $exchangeRates->updateExchangeRates();
    }
}
