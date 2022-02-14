@extends('areas/header')

@section('body')
@include('orders.shared.table', ['collection' => $collection, 'pagination' => true])
@endsection
