$( document ).ready(function() {
    // When currency is selected do the calculations.
    $( "select" )
        .change(function() {
            // Set the variables.
            var surchange = 0;
            var grandTotal = 0;
            var total = 0;
            var discountAmount = 0;
            var discount = 0;
            var subTotal = 0;
            var currencyName = "";
            var usd = $('#usd').val();

            // Details for selected currency.
            // Currency name, total, surchange, grand total, discount amount
            $( "select option:selected" ).each(function() {

                if ($( this ).text() == 'JPY') {
                    var currencySign = '￥';
                    $( "div.totals" ).show();
                    checkIfInputIsEmpty(usd)
                    currencyName += $( this ).text();
                    total += parseFloat((usd * $('#jpy').val()).toFixed(2));
                    surchange = parseFloat((total * (7.5/100)).toFixed(2));
                    grandTotal = parseFloat((total + surchange).toFixed(2));
                    $('.discount-amount-result').hide();
                } else if ($( this ).text() == 'GBP') {
                    var currencySign = '£';
                    $( "div.totals" ).show();
                    checkIfInputIsEmpty(usd)
                    currencyName += $( this ).text();
                    total += parseFloat((usd * $('#gbp').val()).toFixed(2));
                    surchange = parseFloat((total * (5/100)).toFixed(2));
                    grandTotal = parseFloat((total + surchange).toFixed(2));
                    $('.discount-amount-result').hide();
                } else if ($( this ).text() == 'EUR'){
                    var currencySign = '€';
                    $( "div.totals" ).show();
                    checkIfInputIsEmpty(usd)
                    discountAmount = 0.02;
                    currencyName += $( this ).text();
                    total += parseFloat((usd * $('#eur').val()).toFixed(2));
                    surchange = parseFloat((total * (5/100)).toFixed(2));
                    subTotal = parseFloat((total + surchange).toFixed(2));
                    grandTotal = parseFloat((subTotal - (subTotal * discountAmount)).toFixed(2));
                    discount = parseFloat(subTotal - grandTotal).toFixed(2);
                    $('.discount-amount-result').show();
                } else {
                    $( "div.totals" ).hide();
                }
                $( "span.currency-sign").text(currencySign);
            });

            // Display calculations as a quote.
            $( "span.total" ).text( total );
            $( "input.total" ).text( total );
            $( "span.surchange" ).text( surchange );
            $( "span.grand-total" ).text( grandTotal );
            $( "span.discount-amount" ).text( discount );
            $( "span.currency-name" ).text( currencyName );
        })
        .trigger( "change" );

        // Send values to the form when button Buy is clicked.
        $('#buy-currency').on('click', function() {
            // Setting variables.
            var usd = $('#usd').val();
            var currencySelected = $('#sel1').find(":selected").text();
            var discountForEuro = '0%';
            var currencyShortcode = '';
            var surchangePercentage = 0;
            var amountUSD = parseFloat(usd).toFixed(2);
            // Get name and surchange of the currency for passing them to the form.
            if (currencySelected == 'JPY') {
                currencyShortcode += 'JPY';
                surchangePercentage = '7.5%';
            } else if (currencySelected == 'GBP') {
                currencyShortcode += 'GBP';
                surchangePercentage = '5%';
            } else if (currencySelected == 'EUR') {
                currencyShortcode += 'EUR';
                surchangePercentage = '5%';
                discountForEuro = '2%';
            }

            // Sending values to the form fields.
            $('.input-order-total').val($("span.total").text());
            $('.input-surchange-total').val($("span.surchange").text());
            $('.input-discount-amount-total').val($( "span.discount-amount" ).text());
            $('.input-grand-total-total').val($( "span.grand-total" ).text());
            $('.amount-usd').val(amountUSD).text();
            $('.discount-percentage').val(discountForEuro).text();
            $('.currency-purshased-usd').val(currencyShortcode).text();
            $('.surchange-percentage').val(surchangePercentage).text();
        });

        function checkIfInputIsEmpty(usd) {
            if (usd == "") {
                alert("Please, enter the amount of usd dollars you want to purchase.");
                resetUSDInput();
            } else if (usd < 10) {
                alert("Please, enter the amount bigger then 10$.");
                resetUSDInput();
            } else if (usd > 100000) {
                alert("Please, enter the amount smaller then 100 000$.");
                resetUSDInput();
            }
        }

        function resetUSDInput() {
            $('.select-currency option:eq(0)').prop('selected', true);
            $( "div.totals" ).hide();
            $( "#usd" ).val("");
            return false;
        }
});
