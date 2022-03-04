<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th scope="col">{{ __('Order') }}</th>
            <th scope="col">{{ __('Area') }}</th>
            <th scope="col">{{ __('Invoice') }}</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Credit') }}</th>
            <th scope="col">{{ __('Detail') }}</th>
            <th scope="col">{{ __('Created') }}</th>
            <th scope="col">{{ __('Actions') }}</th>
        </tr>
        @foreach ($collection as $i => $entity)
        <tr>
            <td><a href="{{route('orders.show', ['order' => $entity->getOrder()->getId()])}}">{{ $entity->getOrder()->getSequence() }}</a></td>
            <td><a href="{{route('areas.show', ['area' => $entity->getArea()->getId()])}}">{{ $entity->getArea()->getSerial() }}</a></td>
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
                    <a href="{{ route('movements.show', ['movement' => $entity->getId()]) }}" class="btn btn-primary disabled">view</a>
                    <a href="{{ route('movements.edit', ['movement' => $entity->getId()]) }}" class="btn btn-primary disabled">edit</a>
                    {{ Form::submit('delete', ['class' => 'btn btn-primary', 'disabled' => true]) }}
                </div>
            {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        @if ($pagination ?? '')
        <tr align="center">
            <td colspan="7">{{ $collection->links("pagination::bootstrap-4") }}</td>
        </tr>
        @endif
    </table>
</div>
