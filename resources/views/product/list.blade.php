@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">{{ __('Products List') }}</div>
					@if(session()->has('success'))
						<div class="alert alert-success">
						{{ session()->get('success') }}
						</div>
					@endif
					@if(session()->has('error'))
						<div class="alert alert-danger">
						{{ session()->get('error') }}
						</div>
					@endif
				<div class="card-body">
					<table id="list" class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Title</th>
								<th>Code</th>
								<th>Description</th>
								<th>Price</th>
								<th>Image</th>
								<td colspan="2">Action</td>
							</tr>
						</thead>
					<tbody>
					@foreach($products as $product)
						<tr>
							<td>{{ $product->id }}</td>
							<td>{{ $product->title }}</td>
							<td>{{ $product->code }}</td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->price }}</td>
							<td><img src="{{ url('storage/'.$product->image) }}" class="img-fluid" alt="Bad"/></td>
							<td>
							<a href="{{ route('products.edit',$product->id) }}">Edit</a></td>
							<td>
							<form action="{{ route('products.destroy', $product->id)}}" method="post">
							{{ csrf_field() }}
							@method('DELETE')
							<button class="btn btn-danger" type="submit">Delete</button>
							</form>
							</td>
						</tr>
					@endforeach
					</tbody>
					</table>
					<div class="row justify-content-center">
					{{ $products->links()}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection