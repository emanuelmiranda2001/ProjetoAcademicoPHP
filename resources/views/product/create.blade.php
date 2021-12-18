@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
			<div class="card-header">{{ __('New Product') }}</div>
				<div class="card-body">
					<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
					@csrf
						<div class="form-group row">
						<label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
							<div class="col-md-6">
							<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
							@error('title')
								<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							</div>
						</div>
						<div class="form-group row">
						<label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>
							<div class="col-md-6">
							<input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code">
							@error('code')
								<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							</div>
						</div>
						<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
							<div class="col-md-6">
							<textarea style="resize: none;" id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4" cols="50" required autocomplete="description">{{ old('description') }}</textarea>
							@error('description')
								<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							</div>
						</div>
						<div class="form-group row">
						<label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
							<div class="col-md-6">
							<input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">
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
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
							{{ __('New Product') }}
							</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection