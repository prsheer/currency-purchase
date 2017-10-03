<?php

namespace App\Services;

use App\ExchangeRate;

class ExchangeRatesApi
{
    /**
     * Get result from the api
     *
     * @return mixed
     */
    public function getExchangeRatesFromApi() {
        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = '673772b0b360670b17d2900ef289d758';

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        return json_decode($json, true);
    }

    /**
     * Update exchange rates in the database
     *
     * @return bool|void
     */
    public function updateExchangeRates()
    {
        // Get exchange rates from the api.
        $exchangeRates = $this->getExchangeRatesFromApi();
        // Check if success is true.
        $success = $exchangeRates['success'];
        if (!$success) {
            echo 'Something went wrong. Please try again later.';
            return;
        }
        // Empty the exchange rates table.
        ExchangeRate::truncate();
        // Prepare api result for updating in database.
        $quotes = $exchangeRates['quotes'];
        $gbp = [
            'name' => 'British Pound',
            'shortcode' => 'GBP',
            'exchange_rate' => $quotes['USDGBP'],
        ];

        $jen = [
            'name' => 'Japanese Yen',
            'shortcode' => 'JPY',
            'exchange_rate' => $quotes['USDJPY'],
        ];

        $eur = [
            'name' => 'Euro',
            'shortcode' => 'EUR',
            'exchange_rate' => $quotes['USDEUR'],
        ];

        $allCurrencies = [$gbp, $jen, $eur];

        // Insert currencies into database.
        $updateExchangeRate = ExchangeRate::insert($allCurrencies);

        if ($updateExchangeRate) {
            return true;
        }

    }

    /**
     * Get exchange rates
     *
     * @return array
     */
    public function getExchangeRates() {
        $exchangeRates = $this->getExchangeRatesFromApi();

        return $exchangeRates = [
            'gbp' => $exchangeRates['quotes']['USDGBP'],
            'jpy' => $exchangeRates['quotes']['USDJPY'],
            'eur' => $exchangeRates['quotes']['USDEUR'],
        ];
    }
}