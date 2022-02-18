@extends('layout')

@section('sidebar')
    <ul class="my-4">
        <li>
        <a class="{{request()->is('orders*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
        </li>
    </ul>

    <ul class="my-4" style="list-style:none">
        <li>Configuraciones</li>
        <li><a class="link-primary">Límite presupuesto</a></li>
    </ul>
@endsection
