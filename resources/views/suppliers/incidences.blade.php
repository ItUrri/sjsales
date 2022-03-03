@extends('suppliers.show')
 
@section('body')
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm">
        <tr>
            <th>Detail</th>
            <th>Order</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($entity->getIncidences() as $incidence)
        <tr>
            <td>{{ $incidence->getDetail() }}</td>
            <td>@if ($incidence->getOrder()) {{ $incidence->getOrder()->getSequence() }} @endif</td>
            <td>{{ $incidence->getCreated()->format("d/m/Y H:i") }}</td>
            <td>
                {{ Form::open([
                    'route' => ['suppliers.incidences.destroy', $entity->getId(), $incidence->getId()], 
                    'method' => 'delete',
                ]) }}
                    <div class="btn-group btn-group-sm float-end" role="group">
                        <a href="{{ route('suppliers.incidences.edit', ['supplier' => $entity->getId(), 'incidence' => $incidence->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/incidences/{$incidence->getId()}/edit") ? "active" : ""}}'>edit</a>
                        {{ Form::submit('delete', ['class' => 'btn btn-outline-primary']) }}
                    </div>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5"><a href="{{ route('suppliers.incidences.create', ['supplier' => $entity->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/incidences/create") ? "active" : "" }}'>Add incidence</a></td>
        </tr>
    </table>
</div>
@endsection
