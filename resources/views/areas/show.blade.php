@extends('areas/header')

@section('body')
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Orders</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Movements</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>

@include('orders.shared.table', ['collection' => $collection, 'pagination' => true])
@endsection
