@extends('opanel_layout')

@section('content')
<h3>{{ __('Orders') }}</h3>
<form class="form-inline my-2 row" method="get" action="{{ route('areas.index') }}">
    <div class="col col pe-0">
        <input type="text" name="name" placeholder="" class="form-control form-control-sm">
    </div>
    <div class="col col-1 p-0">
        <input type="submit" class="btn btn-sm btn-outline-primary" value="Search"/>
    </div>
    <!--
    <div class="col col-1 ps-0">
        <a href="{{ route('orders.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
    </div>
    -->
</form>
  
@include('orders.shared.table', ['collection' => $orders, 'pagination' => true])
  
@endsection
