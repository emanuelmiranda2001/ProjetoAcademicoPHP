@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
			<div class="card-header">{{ __('Edit Product')}}</div>
				<div class="card-body">
				<form method="POST" action="{{ route('products.update', $product->id )}}" enctype="multipart/form-data">
				@csrf
				@method('patch')
					<div class="form-group row">
					<label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
						<div class="col-md-6">
						<input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"
						value="{{ old('price', $product->price) }}" required autocomplete="price" autofocus>
						@error('price')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						</div>
					</div>
					<div class="form-group row">
					<label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
						<div class="col-md-6">
						<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
						@error('image')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
						@enderror
						</div>
						<div>
						<img src="{{asset('storage/'. $product->image)}}" style="height:120px;">
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
							{{ __('Update') }}
							</button>
						<a href="{{ url('products') }}">Back to List</a>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection