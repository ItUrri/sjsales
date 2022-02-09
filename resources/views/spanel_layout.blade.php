@extends('layout')

@section('sidebar')
    <ul class="my-4">
        <li>
        <a class="{{request()->is('suppliers*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('suppliers.index') }}">Suppliers</a>
        </li>
        <li>
        <a class="{{request()->is('suppliers*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('suppliers.index') }}">Incidences</a>
        </li>
    </ul>

    <ul class="my-4" style="list-style:none">
        <li>Configuraciones</li>
        <li><a class="link-primary">Límite facturado (aviso)</a></li>
    </ul>
@endsection
