@extends('new_layout')
@section('title'){{ __('Suppliers') }}@endsection
@section('btn-toolbar')
    <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-outline-secondary">
    <span data-feather="plus"></span> New
    </a>
@endsection
@section('content')

<div class="table-responsive">
  <table class="table table-hover table-sm align-middle">
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
              <div class="btn-group btn-group-sm" role="group">
                  <a href="{{ route('suppliers.show', ['supplier' => $entity->getId()]) }}" class="btn btn-outline-secondary">
                    <span data-feather="eye"></span>
                  </a>
                  <a href="{{ route('suppliers.edit', ['supplier' => $entity->getId()]) }}" class="btn btn-outline-secondary">
                    <span data-feather="edit-2"></span>
                  </a>
                  {{ Form::button('<span data-feather="trash"></span>', ['class' => 'btn btn-outline-secondary', 'disabled' => $entity->getProducts()->count() ? true : false]) }}
              </div>
          {{ Form::close() }}
          </td>
      </tr>
      @endforeach
      <tr align="center">
          <td colspan="10">{{ $collection->links("pagination::bootstrap-4") }}</td>
      </tr>
      </tbody>
    </table> 
</div>
@endsection
