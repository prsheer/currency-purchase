<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use App\Services\ExchangeRatesApi;

class updateExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-exchange-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rates form the api.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Update exchange rates.
        $exchangeRates = new ExchangeRatesApi();
        $updateExchangeRates = $exchangeRates->updateExchangeRates();
        if ($updateExchangeRates) {
            $this->info('Exchange rates updated successfully.');
        } else {
            $this->info('Something went wrong.');
        }
    }
}
