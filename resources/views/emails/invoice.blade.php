<h2>Order number: {{$order->id}}</h2>
<p>First name: {{$order->customer->firstname}}</p>
<p>Last name: {{$order->customer->lastname}}</p>
<p>Email: {{$order->customer->email}}</p>
<hr>
<p>Paid in USD: {{$order->amount_usd}}</p>
<p>Total: {{$order->total}}</p>
<p>Surchange: {{$order->surchange}}</p>
<p>Discount amount: {{$order->discount_amount}}</p>
<p>Currency purchased: {{$order->currency_purshased}}</p>
<p>Grand total: {{$order->grand_total}}</p>
