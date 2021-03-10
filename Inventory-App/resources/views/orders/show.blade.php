@extends('layouts.app') 

@section('content')

<div class="">

  <ul>
    <h1>Items</h1>
    @foreach($order->names as $name)
  
      <li>{{ $name }}</li>
    @endforeach
  </ul>


</div>

@endsection