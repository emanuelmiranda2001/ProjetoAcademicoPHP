@extends('layouts.app')
@section('content')
<div>
	<div class="d-flex justify-content-center">
	<div class="w-25 p-3" style="background-color: #eee;">
			@if(session('error'))
				<div class="alert alert-danger d-flex justify-content-center" role="alert">
			{{ session('error') }}
			</div>
			@endif
			<h1>Checkout</h1>
			<h4>Your Total: ${{ $total }}</h4>
			<form action="{{ route('checkout') }}" method="post" id="checkout-form">
			@csrf
			<div class="form-group">
				<label for="name">{{ __('Name') }}</label>
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="email">{{ __('E-mail') }}</label>
					<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
					@error('email')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="nif">{{ __('Nif') }}</label>
					<input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ Auth::user()->nif }}" required autocomplete="nif" autofocus>
					@error('nif')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="address">{{ __('Address') }}</label>
					<input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>
					@error('address')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			  <button type="submit" class="btn btn-success">Checkout</button>
			</form>
	</div>
	</div>

@endsection