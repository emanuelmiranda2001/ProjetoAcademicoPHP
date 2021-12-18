@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
			<div class="card-header">{{ __('Edit User')}}</div>
				<div class="card-body">
				<form action="{{ route('users.update-user', $user->id) }} "method="POST"  enctype="multipart/form-data">
				@csrf
				@if(session('success'))
				<div class="alert alert-success" role="alert">
				{{ session('success') }}
				</div>
				@endif
				@method('POST')
					<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
						<div class="col-md-6">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
						value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						</div>
					</div>
					<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
						<div class="col-md-6">
						<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
						value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
						@error('email')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						</div>
					</div>
					<div class="form-group row">
					<label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('Nif') }}</label>
						<div class="col-md-6">
						<input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif"
						value="{{ old('nif', $user->nif) }}" required autocomplete="nif" autofocus>
						@error('nif')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
							{{ __('Update') }}
							</button>
						@role('admin')
						<a href="{{ url('users') }}">Back to List</a>
						@endrole
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection