<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Order;
use App\Services\TotalsCalculator;
use App\Services\ExchangeRatesApi;
use App\Events\OrderCreated;

class IndexController extends Controller
{
    /**
     * Display a listing of the exchange rates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExchangeRatesApi $exchangeRates) {
        $exchangeRates = $exchangeRates->getExchangeRates();
        return view('index')->with('exchangeRates', $exchangeRates);
    }

    /**
     * Insert order and customer details in database
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TotalsCalculator $totals) {

        // Get requested data.
        $data = $request->all();
        // Calculate the totals.
        $totals = $totals->makeTotalsCalculations($data);

        // Prepare data for insert.
        $customer = new Customer([
            'email'     => $totals['email'],
            'firstname' => $totals['firstname'],
            'lastname'  => $totals['lastname'],
        ]);
        // Save customer and order data.
        if ($customer->save()) {
            $order = new Order($totals);
            $saveOrder = $customer->orders()->save($order);

            if ($saveOrder) {
                // Call event - listener to send email to customer.
                event(new OrderCreated($order));

                return ['status'=>'success', 'order_id'=>$order->id];
            }
        }

        return ['status'=>'failed'];
    }
}
