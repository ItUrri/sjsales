<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th scope="col">Order nº</th>
            <th scope="col">Invoice</th>
            <th scope="col">Type</th>
            <th scope="col">Credit</th>
            <th scope="col">Detail</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach ($collection as $i => $entity)
        <tr>
            <td><a href="{{route('orders.show', ['order' => $entity->getOrder()->getId()])}}">{{ $entity->getOrder()->getSequence() }}</a></td>
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
        <tr align="center">
            <td colspan="7">{# $collection->links("pagination::bootstrap-4") #}</td>
        </tr>
    </table>
</div>
