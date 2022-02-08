@extends('cpanel_layout')

@section('content')
<h3>Departments</h3>
<div class="table-responsive table-responsive-sm">
    <table class="table bordered caption-top">
        <caption>List of departments</caption>
        <thead class="table-light border-0">
        <tr>
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
        @foreach ($departments as $i => $entity)
        <tr>
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
                'route' => ['departments.destroy', $entity->getId()], 
                'method' => 'delete',
            ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('departments.show', ['department' => $entity->getId()]) }}" class="btn btn-primary">view</a>
                    <a href="{{ route('departments.edit', ['department' => $entity->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
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
