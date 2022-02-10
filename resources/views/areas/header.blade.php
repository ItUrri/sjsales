@extends('cpanel_layout')
 
@section('content')
<h3>{{$entity->getName()}}</h3>
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th>Type</th>
            <th>Acronym</th>
            <th>Available</th>
            <th>Departments</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{ $entity->getTypeName() }}</td>
            <td>{{ $entity->getSerial() }}</td>
            <td>{{ $entity->getAvailableCredit() }}€
                <div class="small">{{$entity->getCredit() }} (real) - {{$entity->getCompromisedCredit()}} (gasto comprometido)</div></td>
            </td>
            <td>{{ implode(", ", $entity->getDepartments()->map(function ($e) { return $e->getName(); })->toArray()) }}</td>
            <td>
                <div class="input-group">
                    <a href="{{ route('areas.orders.create', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary {{request()->is('areas/*/orders/create') ? 'active' : ''}}">new order</a>
                    <a href="{{ route('areas.edit', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary float-end">edit</a>
                    <a href="{{ route('areas.destroy', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-primary float-end">delete</a>
                </div>
            </td>
        </tr>
    </table>
</div>
   
@yield('body')
@endsection
