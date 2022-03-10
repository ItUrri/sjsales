@extends('new_layout')
@section('title'){{ __('Users') }}@endsection
@section('btn-toolbar')
    <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-secondary">
        <span data-feather="plus"></span> New
    </a>
@endsection
@section('content')
<div class="table-responsive">
<table class="table table-hover table-sm align-middle">
    <thead>
    <tr>
        <th scope="col">{{ __('Avatar') }}</th>
        <th scope="col">{{ __('Email') }}</th>
        <th scope="col">{{ __('Name') }}</th>
        <th scope="col">{{ __('Roles') }}</th>
        <th scope="col">{{ __('Areas') }}</th>
        <th scope="col">{{ __('Created') }}</th>
        <th scope="col">{{ __('Last login') }}</th>
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($collection as $user)
    <tr>
        <td>@if ($user->getAvatar()) <img src="{{ $user->getAvatar() }}" height="25" width="25" class="rounded-circle"/> @endif</td>
        <td>{{ $user->getEmail() }}</td>
        <td>{{ $user->getName() }}</td>
        <td>{{ implode(", ", $user->getRoles()->map(function ($e) { return $e->getName(); })->toArray()) }}</td>
        <td>{{ implode(", ", $user->getAreas()->map(function ($e) { return "{$e->getName()} ({$e->getType()})"; })->toArray()) }}</td>
        <td>{{ $user->getCreated()->format("d/m/Y H:i") }}</td>
        <td>@if ($user->getLastLogin()) {{ $user->getLastLogin()->format("d/m/Y H:i") }} @endif</td>
        <td class="m-0">
            <div class="btn-group btn-group-sm">
                <a href="{{route('users.show', ['user' => $user->getId()])}}" class="btn btn-outline-secondary">
                    <span data-feather="eye"></span>
                </a>
                <a href="{{route('users.edit', ['user' => $user->getId()])}}" class="btn btn-outline-secondary">
                    <span data-feather="edit-2"></span>
                </a>
                <a href="{{route('users.destroy', ['user' => $user->getId()])}}" class="btn btn-outline-secondary">
                    <span data-feather="trash"></span>
                </a>
            </div>
        </td>
    </tr> 
    @endforeach
    </table>
</div>
@endsection

