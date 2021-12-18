@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					@role('admin|manager')
					<ul>
						@foreach($usersList as $user)
							<li>{{$user->name}}</li>
						@endforeach
						@endrole
					</ul>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
