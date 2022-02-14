@extends('areas/header')
 
@section('body')
@include ('movements.shared.table', ['collection' => $collection, 'pagination' => true])
@endsection
