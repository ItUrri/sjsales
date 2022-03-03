@extends('new_layout')
@section('title'){{ __('Areas') }}@endsection
@section('btn-toolbar')
    <a href="{{ route('areas.create') }}" class="btn btn-sm btn-outline-secondary">
    <span data-feather="plus"></span> New
    </a>
@endsection
@section('content')

<div class="table-responsive">
  <table class="table table-hover table-sm align-middle">
    <thead>
    <tr>
        <th scope="col">{{ __('Name') }}</th>
        <th scope="col">{{ __('Acronym') }}</th>
        <th scope="col">{{ __('Type') }}</th>
        <th scope="col">{{ __('Departments') }}</th>
        <th scope="col">{{ __('Created') }}</th>
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody> 
        @foreach ($areas as $i => $entity)
        <tr>
            <td>{{ $entity->getName() }}</td>
            <td>{{ $entity->getSerial() }}</td>
            <td>{{ $entity->getTypeName() }}</td>
            <td>{{ implode(", ", $entity->getDepartments()->map(function ($e) { return $e->getName(); })->toArray()) }}</td>
            <td>{{ $entity->getCreated()->format("d/m/Y H:i") }}</td>
            <td>
            {{ Form::open([
                'route' => ['areas.destroy', $entity->getId()], 
                'method' => 'delete',
            ]) }}
            <a href="{{ route('areas.orders.create', ['area' => $entity->getId()]) }}" class="btn btn-sm btn-outline-secondary"><span data-feather="file"></span> {{ __('New order') }}</a>
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('areas.show', ['area' => $entity->getId()]) }}" class="btn btn-outline-secondary">
                    <span data-feather="eye"></span>
                </a>
                <a href="{{ route('areas.edit', ['area' => $entity->getId()]) }}" class="btn btn-outline-secondary">
                    <span data-feather="edit-2"></span>
                </a>
                {{ Form::button('<span data-feather="trash"></span>', ['class' => 'btn btn-outline-secondary', 'type' => 'submit']) }}
            </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody> 
    </table> 
</div>

@endsection
