@section('order')
<!-- Modal -->
<div id="form-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Place your order</h4>
            </div>
            <div class="modal-body">
                <form id="checkout-form" action="#" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="amount_usd" class="amount-usd" value="">
                    <input type="hidden" name="discount_percentage" class="discount-percentage" value="">
                    <input type="hidden" name="currency_purshased" class="currency-purshased-usd"  value="">
                    <input type="hidden" name="surchange_percentage" class="surchange-percentage"  value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="firstName">First name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <hr>
                    <!-- Order Details -->
                    <div class="form-group input-total">
                        <label for="total">Total: <span class="currency-sign"></span><span class="order-total-result"></span> </label>
                        <input type="text" value="" class="form-control input-order-total" readonly name="total" >
                    </div>

                    <div class="form-group input-surchange">
                        <label for="surchange">Surchange: <span class="currency-sign"></span><span class="order-surchange-result"></span> </label>
                        <input type="text" value="" class="form-control input-surchange-total" readonly name="surchange" >
                    </div>

                    <div class="form-group input-discount-amount">
                        <label for="discount-amount">Discount amount: <span class="currency-sign"></span> <span class="order-discount-amount-result"></span> </label>
                        <input type="text" value="" class="form-control input-discount-amount-total" readonly name="discount_amount" >
                    </div>

                    <div class="form-group input-grand-total">
                        <label for="grand-total">Grand total: <span class="order-grand-total-result"></span> </label>
                        <input type="text" value="" class="form-control input-grand-total-total" readonly name="grand_total" >
                    </div><hr>
                    <input type="submit" class="btn btn-primary" id="checkout" value="Place My Order">
                </form>
            </div><!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /#form-modal -->
    <script>
        var checkout = $("#checkout-form");  //form id
        checkout.submit(function(e){
            e.preventDefault();
            var formData = checkout.serialize();
            $.ajax({
                url:"create",
                method:'post',
                data:formData,
                success:function(data){
                    if( data.status == 'success' ){
                        window.location = '{{ route('success', 0) }}'.replace('/0', '/'+data.order_id);
                    }else{
                        alert('Error: You probably forget to set mailtrap settings. If you dont have mailtrap, please use another currency for purchase instead GBP.');
                    }
                },
                error: function (data) {
                    alert('Error: You probably forget to set mailtrap settings. If you dont have mailtrap, please use another currency for purchase instead GBP.');
                }
            });
        });
    </script>
@endsection