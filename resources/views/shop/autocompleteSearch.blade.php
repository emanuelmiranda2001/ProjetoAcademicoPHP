@extends('layouts.app')
@section('content')

<div class="container mt-4">
 
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      <h2>Search</h2>
    </div>
 
    <div class="card-body">
      <form name="autocomplete-textbox" id="autocomplete-textbox" method="post" action="shops">
       @csrf
 
        <div class="form-group">
          <label for="exampleInputEmail1">Search Product By Name</label>
          <input type="text" id="name" name="name" class="form-control">
        </div>
 
      </form>
    </div>
  </div>
</div>  
@endsection
 

 
