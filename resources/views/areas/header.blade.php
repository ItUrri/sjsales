@extends('cpanel_layout')
 
@section('content')
<h3>{{$entity->getName()}}</h3>
   
<div class="row">
    <div class="col-6 mb-3 border">
        <div><strong>Acronym</strong>: {{$entity->getSerial() }}</div>
        <div><strong>Type</strong>: {{$entity->getTypeName() }}</div>
        <div><strong>Credit</strong>: {{$entity->getCredit() }} €</div>
        <div class="input-group">
            <a href="{{ route('areas.orders.create', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary {{request()->is('areas/*/orders/create') ? 'active' : ''}} me-4">new order</a>
            <a href="{{ route('areas.edit', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary float-end">edit</a>
            <a href="{{ route('areas.destroy', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary float-end">delete</a>
        </div>
    </div>
    <fieldset class="col-6 mb-3 border">
        <legend>Departments</legend>
        <ul class="list-inline">
        @foreach ($entity->getDepartments() as $dp)
            <li>{{$dp->getName() }}</li>
        @endforeach
        </ul>
    </fieldset>
</div>
@yield('body')
@endsection
