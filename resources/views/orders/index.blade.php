@extends('opanel_layout')

@section('content')
<h3>Orders</h3>
<form class="form-inline my-2 row" method="get" action="{{ route('areas.index') }}">
    <div class="col col pe-0">
        <input type="text" name="name" placeholder="" class="form-control form-control-sm">
    </div>
    <div class="col col-1 p-0">
        <input type="submit" class="btn btn-sm btn-outline-primary" value="Search"/>
    </div>
    <!--
    <div class="col col-1 ps-0">
        <a href="{{ route('orders.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
    </div>
    -->
</form>
  
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th scope="col">Area</th>
            <th scope="col">Order nº</th>
            <th scope="col">Products</th>
            <th scope="col">Estimated</th>
            <th scope="col">Status</th>
            <th scope="col">Credit</th>
            <th scope="col">Detail</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach ($orders as $i => $order)
        <tr>
            <td><a href="{{ route('areas.show', ['area' => $order->getArea()->getId()]) }}">{{ $order->getArea() }}</a></td>
            <td>{{ $order->getSequence() }}</td>
            <td>{{ $order->getProducts()->count() }}</td>
            <td>{{ $order->getEstimatedCredit() }}€</td>
            <td>{{ $order->getStatusName() }}</td>
            <td>@if ($order->getCredit()) {{ $order->getCredit() }}€ @endif</td>
            <td>{{ $order->getDetail() }}</td>
            <td>{{ $order->getCreated()->format("d/m/Y H:i") }}</td>
            <td>
            {{ Form::open([
                'route' => ['orders.destroy', $order->getId()], 
                'method' => 'delete',
            ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('orders.show', ['order' => $order->getId()]) }}" class="btn btn-primary">view</a>
                    <a href="{{ route('orders.edit', ['order' => $order->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
                    {{ Form::submit('delete', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        <tr align="center">
            <td colspan="5">{!! $orders->links("pagination::bootstrap-4") !!}</td>
        </tr>
    </table>
</div>
  
@endsection
