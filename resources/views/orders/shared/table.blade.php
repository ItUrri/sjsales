<div class="table-responsive table-responsive-sm mt-2">
    <table class="table table-sm table-bordered">
        <tr>
            <th scope="col">Order nº</th>
            <th scope="col">Area</th>
            <th scope="col">Type</th>
            <th scope="col">Products</th>
            <th scope="col">Estimated</th>
            <th scope="col">Status</th>
            <th scope="col">Credit</th>
            <th scope="col">Detail</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach ($collection as $i => $order)
        <tr>
            <td><a href="{{ route('orders.show', ['order' => $order->getId()]) }}">{{ $order->getSequence() }}</a></td>
            <td><a href="{{ route('areas.show', ['area' => $order->getArea()->getId()]) }}">{{ $order->getArea()->getName() }}</a></td>
            <td>{{ $order->getArea()->getTypeName() }}</td>
            <td>{{ $order->getProducts()->count() }}</td>
            <td>{{ $order->getEstimatedCredit() }}€</td>
            <td>{{ $order->getStatusName() }}</td>
            <td>@if ($order->getCredit()) {{ $order->getCredit() }}€ @endif</td>
            <td>{{ $order->getDetail() }}</td>
            <td>{{ $order->getDate()->format("d/m/Y H:i") }}</td>
            <td>
            {{ Form::open([
                'route' => ['orders.destroy', $order->getId()], 
                'method' => 'delete',
            ]) }}
                <div class="btn-group btn-group-sm float-end" role="group">
                    <a href="{{ route('orders.show', ['order' => $order->getId()]) }}" class="btn btn-outline-primary">view</a>
                    <a href="" class="btn btn-outline-primary"><i class="fa fa-pencil"></i> edit</a>
                    @if ($order->isStatus(\App\Entities\Order::STATUS_PAID))
                    <a href="" class="btn btn-outline-primary">receive</a>
                    @else 
                    {{ Form::submit('delete', ['class' => 'btn btn-outline-primary']) }}
                    @endif
                </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        @if ($pagination ?? '')
        <tr align="center">
            <td colspan="9">{{ $collection->links("pagination::bootstrap-4") }}</td>
        </tr>
        @endif
    </table>
</div>
