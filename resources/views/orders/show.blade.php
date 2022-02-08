@extends('opanel_layout')
 
@section('content')
<h3>Order nº {{$order->getSequence()}}</h3>
<div class="row">
    <div class="col-md-6 border">
        <div><strong>Area</strong>: <a href="{{ route('areas.show', ['area' => $order->getArea()->getId()]) }}">{{ $order->getArea() }}</a></div>
        <div>{{ implode(", ", $order->getArea()->getDepartments()->map(function ($e) { return $e->getName(); })->toArray()) }}</div>
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
                            <div class="btn-group btn-group-sm float-end" role="group">
                                <a href="{{ route('orders.products.edit', ['order' => $order->getId(), 'product' => $product->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
                                {{ Form::submit('delete', ['class' => 'btn btn-primary']) }}
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
        <div class="table-responsive table-responsive-sm">
            <table class="table table-sm table-bordered">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">nº</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Type</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Created</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach ($order->getMovements() as $i => $entity)
                <tr>
                    <td scope="row">{{ $entity->getId() }}</td>
                    <td>{{ $entity->getOrder()->getSequence() }}</td>
                    <td>{{ $entity->getInvoice() }}</td>
                    <td>{{ $entity->getTypeName() }}</td>
                    <td>{{ $entity->getCredit() }}€</td>
                    <td>{{ $entity->getDetail() }}</td>
                    <td>{{ $entity->getCreated()->format("d/m/Y H:i") }}</td>
                    <td>
                    {{ Form::open([
                        'route' => ['movements.destroy', $entity->getId()], 
                        'method' => 'delete',
                    ]) }}
                        <div class="btn-group btn-group-sm float-end" role="group">
                            <a href="{{ route('movements.show', ['movement' => $entity->getId()]) }}" class="btn btn-primary">view</a>
                            <a href="{{ route('movements.edit', ['movement' => $entity->getId()]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> edit</a>
                            {{ Form::submit('delete', ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </fieldset>
</div>
  
@endsection
