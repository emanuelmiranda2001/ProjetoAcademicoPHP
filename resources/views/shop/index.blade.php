@extends('layouts.app')
@section('content')

<div>
@if(session('success'))
	<div class="alert alert-success w-25 p-3 justify-content-center" role="alert">
{{ session('success') }}
</div>
@endif
</div>
<div>
@foreach ($products->chunk(3) as $productChunk)

	<div class="album py-5 bg-light">
    <div class="container">
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
		@foreach($productChunk as $product)
			<div class="col">
            <div class="card shadow-sm px-2 py-2">
                <img src="{{ url('storage/'.$product->image) }}" alt="Bad" class="img-fluid bd-placeholder-img card-img-top"/>
                <div class="caption">
                    <h3>{{ $product->title }}</h3>
                    <p class="description">{{ $product->description }}</p>
                    <div class="clearfix">
                        <div class="pull-left price">{{ $product->price }}</div>
                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
			</div>  
		@endforeach
           
    </div>
	</div>
	</div>

@endforeach
</div>
@endsection