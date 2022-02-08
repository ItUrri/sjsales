@extends('spanel_layout')

@section('content')
<h3>Suppliers</h3>

<form class="form-inline row">
    <div class="col col pe-0">
        <input type="text" name="name" placeholder="" class="form-control form-control-sm">
    </div>
    <div class="col col-1 p-0">
        <input type="submit" class="btn btn-sm btn-outline-primary" value="Search"/>
    </div>
    <div class="col col-1 ps-0">
        <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
    </div>
</form>

<div class="table-responsive table-responsive-sm">
    <table class="table bordered caption-top">
        <caption>List of suppliers</caption>
        <thead class="table-light border-0">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Created</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Data</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($collection as $i => $entity)
        <tr>
            <th scope="row">{{ $entity->getId() }}</th>
            <td>{{ $entity->getName() }}</td>
            <td>{{ $entity->getCreated()->format("d/m/Y H:i") }}</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
            <td>
            {{ Form::open([
                'route' => ['suppliers.destroy', $entity->getId()], 
                'method' => 'delete',
            ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('suppliers.show', ['supplier' => $entity->getId()]) }}" class="btn btn-primary">view</a>
                    <a href="{{ route('suppliers.edit', ['supplier' => $entity->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
                    {{ Form::submit('delete', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table> 
</div>
@endsection
