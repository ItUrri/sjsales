@extends('spanel_layout')
 
@section('content')
<h3>{{$entity->getName()}}</h3>
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th>NIF</th>
            <th>Zip</th>
            <th>Location</th>
            <th>Address</th>
            <th>Acceptable</th>
            <th>Recommended</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{ $entity->getNif() }}</td>
            <td>{{ $entity->getZip() }}</td>
            <td>{{ $entity->getCity() }}</td>
            <td>{{ $entity->getAddress() }}</td>
            <td>{{ $entity->getAcceptable() ? "Yes":"No" }}</td>
            <td>{{ $entity->getRecommendable() ? "Yes":"No" }}</td>
            <td>
                {{ Form::open([
                    'route' => ['suppliers.destroy', $entity->getId()], 
                    'method' => 'delete',
                ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('suppliers.edit', ['supplier' => $entity->getId()]) }}" class='btn btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/edit")?" active":"" }}'>edit</a>
                    {{ Form::submit('delete', ['class' => 'btn btn-sm btn-outline-primary', 'disabled' => true]) }}
                </div>
                {{ Form::close() }}
            </td>
        </tr>
    </table>
</div>
   
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class='nav-link {{request()->is("suppliers/{$entity->getId()}", "suppliers/{$entity->getId()}/contacts*")?" active":"" }}' href="{{ route('suppliers.show', ['supplier' => $entity->getId()]) }}">Contacts <span class="badge">{{ $entity->getContacts()->count() }}</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('suppliers/*/incidences*')?' active':'' }}" href="{{ route('suppliers.incidences.index', ['supplier' => $entity->getId()]) }}" tabindex="-1" aria-disabled="true">Incidences <span class="badge">{{ $entity->getIncidences()->count() }}</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('suppliers/*/invoiceds*')?' active':'' }}" href="{{ route('suppliers.invoiceds.index', ['supplier' => $entity->getId()]) }}" tabindex="-1" aria-disabled="true">Invoiced</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('suppliers/*/orders*')?' active':'' }}" href="{{ route('suppliers.orders.index', ['supplier' => $entity->getId()]) }}" tabindex="-1" aria-disabled="true">Orders</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('suppliers/*/movements*')?' active':'' }}" href="{{ route('suppliers.movements.index', ['supplier' => $entity->getId()]) }}" tabindex="-1" aria-disabled="true">Movements</a>
  </li>
</ul>

<div class="pt-2">
    @yield('body')
</div>
@endsection
