<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoice;

class SendOrderEmail
{
    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        if( $event->order->currency_purshased != 'GBP' ) return false;

        $order = $event->order;
        $email = $order->customer->email;

        Mail::to($email)->send(new OrderInvoice($order));
    }
}
