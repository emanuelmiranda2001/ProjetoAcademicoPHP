@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<h2>Orders</h2>
			@foreach($orders as $order)
			<div class="panel panel-default">
			<h4>Order ID: {{ $order->id }} </h4>
			@role('admin')<h4>User: {{ $order->name }}</h4>@endrole
			  <div class="panel-body">
				<ul class="list-group">
					@foreach($order->cart->items as $item)
					<li class="list-group-item">
						<span class="badge">${{ $item['price'] }}</span>
							{{ $item['item']['title'] }} | {{ $item['qty'] }} Units
					</li>
					@endforeach
				</ul>
			  </div>
			  <div class="panel-footer">
				<strong>Total Price: ${{ $order->cart->totalPrice }}</strong>
			  </div>
			</div>
			<hr>
			<br>
			@endforeach
			
		</div>
	</div>
</div>

@endsection