@extends('spanel_layout')
 
@section('content')
<h3>{{$entity->getName()}}</h3>
   
<div class="row">
    <div class="col-6 mb-3 border">
        <div><strong>Nif</strong>: {{$entity->getNif() }}</div>
        <div><strong>Zip</strong>: {{$entity->getZip() }}</div>
        <div><strong>City</strong>: {{$entity->getCity() }}</div>
        <div><strong>Address</strong>: {{$entity->getAddress() }}</div>
        <div class="input-group">
            <a href="" class="btn btn-sm btn-outline-primary">edit</a>
            <a href="" class="btn btn-sm btn-outline-primary">delete</a>
        </div>
    </div>
    <fieldset class="col-6 mb-3 border">
        <div class="row">
            <legend>Contacts</legend>
            <div class="col-12 border">
            <a href="{{ route('suppliers.contacts.create', ['supplier' => $entity->getId()]) }}" class='btn btn-sm btn-outline-primary float-end {{request()->is("suppliers/{$entity->getId()}/contacts/create") ? "active" : "" }}'>Add contact</a>
            </div>
            @foreach ($entity->getContacts() as $contact)
            <div class="col-4 border">
                <div><strong>Name</strong>: {{$contact->getName() }}</div>
                <div><strong>Position</strong>: {{$contact->getPosition() }}</div>
                <div><strong>Email</strong>: {{$contact->getEmail() }}</div>
                <div><strong>Phone</strong>: {{$contact->getPhone() }}</div>
                <div class="input-group">
                    <a href="{{ route('suppliers.contacts.edit', ['supplier' => $entity->getId(), 'contact' => $contact->getId()]) }}" class='btn btn-sm btn-outline-primary {{request()->is("suppliers/{$entity->getId()}/contacts/{$contact->getId()}/edit") ? "active" : ""}}'>edit</a>
                    <a href="" class="btn btn-sm btn-outline-primary">delete</a>
                </div>
            </div>
            @endforeach
        </div>
    </fieldset>
</div>
<div class="row">
    @yield('body')
</div>
@endsection
