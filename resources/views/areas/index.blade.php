@extends('cpanel_layout')

@section('content')
<h3>Areas</h3>
<form class="form-inline my-2 row" method="get" action="{{ route('areas.index') }}">
    <div class="col col-3 pe-0">
        {{ Form::select('type', [
            null => '-- All types --',
            \App\Entities\Area::TYPE_EQUIPAMIENTO => \App\Entities\Area::typeName(\App\Entities\Area::TYPE_EQUIPAMIENTO),
            \App\Entities\Area::TYPE_FUNGIBLE => \App\Entities\Area::typeName(\App\Entities\Area::TYPE_FUNGIBLE),
            \App\Entities\Area::TYPE_LANBIDE => \App\Entities\Area::typeName(\App\Entities\Area::TYPE_LANBIDE),
        ], null, ['class'=>'form-select form-select-sm']) }}
    </div>
    <div class="col col-2 p-0">
    <input type="text" name="acronym" placeholder="Acronym" class="form-control form-control-sm">
    </div>
    <div class="col col-2 p-0">
    <input type="text" name="name" placeholder="Name" class="form-control form-control-sm">
    </div>
    <div class="col col-3 p-0">
       <select name="department" class="form-select form-select-sm">
        <option>-- All departaments --</option>
        @foreach ($departments as $e)
            <option value="{{ $e->getId() }}">{{ $e->getName() }}</option>
        @endforeach
       </select> 
    </div>
    <div class="col col-1 p-0">
        <input type="submit" class="btn btn-sm btn-outline-primary" value="Search"/>
    </div>
    <div class="col col-1 ps-0">
        <a href="{{ route('areas.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
    </div>
</form>
  
<div class="table-responsive table-responsive-sm">
    <table class="table bordered">
        <tr>
            <th scope="col">ID</th>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Departments</th>
            <th scope="col">Created</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Order</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach ($areas as $i => $entity)
        <tr>
            <th scope="row">{{ $entity->getId() }}</th>
            <td>{{ $entity->getSerial() }}</td>
            <td>{{ $entity->getName() }}</td>
            <td>{{ $entity->getTypeName() }}</td>
            <td>{{ $entity->getDepartments()->count() }}</td>
            <td>{{ $entity->getCreated()->format("d/m/Y H:i") }}</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>
                <a href="{{ route('areas.orders.create', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-primary">new order</a>
            </td>
            <td>
            {{ Form::open([
                'route' => ['areas.destroy', $entity->getId()], 
                'method' => 'delete',
            ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('areas.show', ['area' => $entity->getId()]) }}" class="btn btn-primary">view</a>
                    <a href="{{ route('areas.edit', ['area' => $entity->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
                    {{ Form::submit('delete', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </table> 
</div>

@endsection
