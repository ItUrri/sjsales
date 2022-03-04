@extends('suppliers.show')
 
@section('body')
@include ('orders.shared.table', ['collection' => $collection, 'pagination' => true])
@endsection
