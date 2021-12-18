@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">{{ __('Users List') }}</div>
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
								<th>Name</th>
								<th>E-mail</th>
								<th>Nif</th>
								<td colspan="2">Action</td>
							</tr>
						</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->nif }}</td>
							<td>
							<a href="{{ route('users.edit',$user->id) }}">Edit</a>
							<form action="{{ route('users.destroy', $user->id)}}" method="post">
							{{ csrf_field() }}
							@method('DELETE')
							<button class="btn btn-danger" type="submit">Delete</button>
							</form>
							</td>
							
						</tr>
					@endforeach
					</tbody>
					</table>
					
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection