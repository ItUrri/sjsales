@extends('suppliers/header')
 
@section('body')
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        @foreach ($entity->getContacts() as $contact)
        <tr>
            <td>{{ $contact->getName() }}</td>
            <td>{{ $contact->getPosition() }}</td>
            <td>{{ $contact->getEmail() }}</td>
            <td>{{ $contact->getPhone() }}</td>
            <td>
                {{ Form::open([
                    'route' => ['suppliers.contacts.destroy', $entity->getId(), $contact->getId()], 
                    'method' => 'delete',
                ]) }}
                    <div class="btn-group btn-group-sm float-end" role="group">
                        <a href="{{ route('suppliers.contacts.edit', ['supplier' => $entity->getId(), 'contact' => $contact->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/contacts/{$contact->getId()}/edit") ? "active" : ""}}'>edit</a>
                        {{ Form::submit('delete', ['class' => 'btn btn-outline-primary']) }}
                    </div>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5"><a href="{{ route('suppliers.contacts.create', ['supplier' => $entity->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/contacts/create") ? "active" : "" }}'>Add contact</a></td>
        </tr>
    </table>
</div>
@endsection
