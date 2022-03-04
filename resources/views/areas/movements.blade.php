@extends('areas.show')
 
@section('body')
@include ('movements.shared.table', ['collection' => $collection, 'pagination' => true])
@endsection
