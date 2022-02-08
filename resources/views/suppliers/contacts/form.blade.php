@extends('suppliers/header')

@section('body')
<h4>@if ($contact->getId()) Edit contact @else New contact @endif</h4>
<form action="{{ $route }}" method="POST" class="row">
    @csrf
    {{ method_field($method ?? 'POST') }}
    <div class="col-md-6 mb-1 has-validations">
        <label for="name">Name</label>
        {{ Form::text("name", $contact->getName(), ["class" => "form-control form-control-sm" . ($errors->has("name") ? " is-invalid":"")]) }}
        @if ($errors->has("name"))
           <div class="invalid-feedback">{!! $errors->first("name") !!}</div>
        @endif
    </div>
    <div class="col-md-6 mb-1 has-validations">
        <label for="position">Position</label>
        {{ Form::text("position", $contact->getPosition(), ["class" => "form-control form-control-sm" . ($errors->has("position") ? " is-invalid":"")]) }}
        @if ($errors->has("position"))
           <div class="invalid-feedback">{!! $errors->first("position") !!}</div>
        @endif
    </div>
    <div class="col-md-6 mb-1 has-validations">
        <label for="email">Email</label>
        {{ Form::text("email", $contact->getEmail(), ["class" => "form-control form-control-sm" . ($errors->has("email") ? " is-invalid":"")]) }}
        @if ($errors->has("email"))
           <div class="invalid-feedback">{!! $errors->first("email") !!}</div>
        @endif
    </div>
    <div class="col-md-6 mb-1 has-validations">
        <label for="phone">Phone</label>
        {{ Form::text("phone", $contact->getPhone(), ["class" => "form-control form-control-sm" . ($errors->has("phone") ? " is-invalid":"")]) }}
        @if ($errors->has("phone"))
           <div class="invalid-feedback">{!! $errors->first("phone") !!}</div>
        @endif
    </div>
    <div class="col-md-12">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}
        <a href="{{ route('suppliers.show', ['supplier' => $entity->getId()]) }}" class="btn btn-sm float-end">Cancel</a>
    </div>
</form>
@endsection
 
