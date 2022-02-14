@extends('opanel_layout')
 
@section('content')
<h3>Order nº {{$order->getSequence()}}</h3>
<div class="row">
    <div class="col-md-6 border">
        <div><strong>Area</strong>: <a href="{{ route('areas.show', ['area' => $order->getArea()->getId()]) }}">{{ $order->getArea() }}</a></div>
        <div><strong>Status</strong>: {{ $order->getStatusName() }}</div>
        <div><strong>Estimated Credit</strong>: {{ $order->getEstimatedCredit() }} € | <strong>Credit</strong>: {{ $order->getCredit() }} €</div>
        <div><strong>Created</strong>: {{ $order->getCreated()->format("d/m/Y H:i") }}</div>
        <div><strong>Detail</strong>: {{ $order->getDetail() }}</div>
    </div>
    <fieldset class="col-md-6 border">
        <legend>Products</legend>
        <div class="table-responsive table-responsive-sm">
            <table class="table table-sm table-bordered">
                <tr>
                    <th scope="col">Supplier</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Action</th>
                </tr>
                @foreach ($order->getProducts() as $i => $product)
                <tr>
                    <td><a href="{{ route('suppliers.show', ['supplier' => $product->getSupplier()->getId()]) }}">{{ $product->getSupplier()->getName() }}</td>
                    <td>{{ $product->getDetail() }}</td>
                    <td>{{ $product->getCredit() }}€</td>
                    <td>
                        {{ Form::open([
                            'route' => ['orders.products.destroy', $order->getId(), $product->getId()], 
                            'method' => 'delete',
                        ]) }}
                            <a href="{{ route('suppliers.incidences.create', ['supplier' => $product->getSupplier()->getId()]) }}" class="btn btn-sm btn-primary">new incidence</a>
                            <div class="btn-group btn-group-sm float-end" role="group">
                                <a href="{{ route('orders.products.edit', ['order' => $order->getId(), 'product' => $product->getId()]) }}" class="btn btn-primary disabled"><i class="fa fa-pencil"></i> edit</a>
                                {{ Form::submit('delete', ['class' => 'btn btn-primary disabled']) }}
                            </div>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </fieldset>
    <fieldset class="col-md-12 border">
        <legend>Movements</legend>
        @include('movements.shared.table', ['collection' => $order->getMovements()])

    </fieldset>
</div>
  
@endsection
