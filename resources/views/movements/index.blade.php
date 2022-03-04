@extends('new_layout')
@section('title'){{ __('Movements') }}@endsection
@section('btn-toolbar')
    <a href="{{ route('movements.create') }}" class="btn btn-sm btn-outline-secondary" title="{{__('New')}}">
        <span data-feather="plus"></span> New
    </a>
@endsection

@section('content')
  
@include ('movements.shared.table', ['collection' => $collection, 'pagination' => true])
  
@endsection
