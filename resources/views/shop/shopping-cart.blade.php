@extends('layouts.app')
@section('content')

	@if(Session::has('cart'))
		<div class="table-responsive">
			<table class="table">
				<tr><th colspan="6"> <h3>Order Details</h3></th></tr>
				<tr>
					<th width="35%">Product Name</th>
					<th width="10%">ID</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price</th>
					<th width="15%">Total</th>
					<th width="5%">Action</th>
				</tr>
				@foreach($products as $product)
				<tr>
					<td><strong>{{ $product['item']['title'] }}</strong></td>
					<td><strong>{{ $product['item']['id'] }}</strong></td>
					<td><span class="badge badge-secondary">{{ $product['qty'] }}</span></td>
					<td><span class="badge badge-secondary">{{ $product['item']['price'] }}</span></td>
					<td><span class="badge badge-success">{{ $product['price'] }}</span></td>
					<td> 
					<a href="{{ route('product.reduceByOne', ['id'=>$product['item']['id']]) }}" type="button" class="btn btn-warning">Reduce</a>
					<a href="{{ route('product.remove', ['id'=>$product['item']['id']]) }}" type="button" class="btn btn-danger">Delete</a>				
					</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>{{ $totalPrice }}</strong></td>
					<td><a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a></td>
				</tr>
			</table>
		</div>
		
		@else
			<div class="row justify-content-md-center">
				<h2 >No Items in Cart!</h2>
			</div>
	@endif

@endsection