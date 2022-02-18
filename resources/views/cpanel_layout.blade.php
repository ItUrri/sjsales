@extends('layout')
 
@section('sidebar')
    <!--
    <div class="list-group list-group-sm">
        <a class="list-group-item list-group-item-action {{request()->is('areas*') ? 'list-group-item-primary' : ''}}" href="{{ route('areas.index') }}">Areas</a>
        <a class="list-group-item list-group-item-action {{request()->is('departments*') ? 'list-group-item-primary' : ''}}" href="{{ route('departments.index') }}">Departments</a>
    </div>
    -->
    <ul class="my-4">
        <li>
        <a class="{{request()->is('areas*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('areas.index') }}">{{ trans_choice('Area|Areas', 2) }}</a>
        </li>
        <li>
        <a class="{{request()->is('departments*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('departments.index') }}">{{ trans_choice('Department|Departments', 2) }}</a>
        </li>
    </ul>
@endsection
