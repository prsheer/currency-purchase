@extends('partials/layout')
@extends('partials/navigation')
@extends('partials/order')

@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-5">Thank you {{$order->customer->firstname}} {{$order->customer->lastname}} !</h1>
            <p class="lead">You purchased {{$order->grand_total}} {{$order->currency_purshased}} for {{$order->amount_usd}} USD.</p>
            @if ($order->currency_purshased == "GBP")
            <p>An email has been sent to {{$order->customer->email}} with order details</p>
                @endif
        </div>
    </div>
</div>

@endsection
@section('footer')
@endsection