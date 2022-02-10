@extends('spanel_layout')
 
@section('content')
<h3>{{$entity->getName()}}</h3>
<div class="table-responsive table-responsive-sm">
    <table class="table table-sm table-bordered">
        <tr>
            <th>NIF</th>
            <th>Zip</th>
            <th>Location</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{ $entity->getNif() }}</td>
            <td>{{ $entity->getZip() }}</td>
            <td>{{ $entity->getCity() }}</td>
            <td>{{ $entity->getAddress() }}</td>
            <td>
                <div class="input-group">
                    <a href="" class="btn btn-sm btn-outline-primary">edit</a>
                    <a href="" class="btn btn-sm btn-outline-primary">delete</a>
                </div>
            </td>
        </tr>
    </table>
</div>
<h4>Contacts</h4>
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
                <div class="input-group">
                    <a href="{{ route('suppliers.contacts.edit', ['supplier' => $entity->getId(), 'contact' => $contact->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/contacts/{$contact->getId()}/edit") ? "active" : ""}}'>edit</a>
                    <a href="" class="btn btn-sm btn-outline-primary">delete</a>
                </div>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5"><a href="{{ route('suppliers.contacts.create', ['supplier' => $entity->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/contacts/create") ? "active" : "" }}'>Add contact</a></td>
        </tr>
    </table>
</div>
   
<div class="row">
    @yield('body')
</div>
@endsection
