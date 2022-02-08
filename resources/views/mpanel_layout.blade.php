@extends('layout')

@section('sidebar')
    <ul class="my-4">
        <li>
        <a class="{{request()->is('movements*') ? 'link-secondary' : 'link-primary'}}" href="{{ route('movements.index') }}">Cargos por factura</a>
        </li>
        <li>
        <a class="link-primary" href="">Cobros en caja</a>
        </li>
    </ul>

    <ul class="my-4" style="list-style:none">
        <li>Conf Importaciones</li>
    </ul>
@endsection
