@extends('partials/layout')
@extends('partials/navigation')
@extends('partials/order')

@section('content')

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Foreign currency purchase application</h1>
                <p class="lead">The P.I.M. Company GmbH - PHP Developer practical test</p>
            </div>
        </div>
    </div><hr>
    <div class="container form-wrapper">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="string">Insert usd dollars:</label>
                    <input type="number" class="form-control" id="usd" name="usd">
                    @foreach ($exchangeRates  as $key => $value)
                        <input type="hidden" class="form-control" id="{{$key}}" value="{{$value}}">
                    @endforeach
                </div>
                <div class="form-group select-currency">
                    <label for="select-currency">Select currency:</label>
                    <select class="form-control" id="sel1">
                        <option>-- Please select --</option>
                        @foreach ($exchangeRates  as $key => $value)
                            <option>{{strtoupper($key)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <blockquote class="blockquote">
                    <div class="totals">
                        <div class="total-result">Total: <span class="total"></span> <span class="currency-sign"></span></div>
                        <div class="surchange-result">Surchange: <span class="surchange"></span> <span class="currency-sign"></span></div>
                        <div class="discount-amount-result">Discount amount: <span class="discount-amount"></span> <span class="currency-sign"></span></div>
                        <div class="grand-total-result">Grand total: <span class="grand-total"></span> <span class="currency-sign"></span></div><hr>
                        <button id="buy-currency" type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal">Buy               <span class="currency-name"></span> </button>
                    </div>
                </blockquote>
            </div>
            <div class="col-lg-4"></div>
        </div><!-- /.row -->
    </div><!-- /.container.form-wrapper -->

@endsection
@section('footer')
@endsection