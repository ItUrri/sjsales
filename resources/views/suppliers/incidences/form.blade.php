@extends('suppliers/header')

@section('body')
<h4>@if ($incidence->getId()) Edit incidence @else New incidence @endif</h4>
<form action="{{ $route }}" method="POST" class="row">
    @csrf
    {{ method_field($method ?? 'POST') }}
    <div class="col-md-12 mb-1 has-validations">
        <label for="detail">Detail</label>
        {{ Form::textarea("detail", $incidence->getDetail(), ["class" => "form-control form-control-sm" . ($errors->has("detail") ? " is-invalid":""), 'rows' => 2]) }}
        @if ($errors->has("detail"))
           <div class="invalid-feedback">{!! $errors->first("detail") !!}</div>
        @endif
    </div>
    <div class="col-md-12">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}
        <a href="{{ route('suppliers.incidences.index', ['supplier' => $entity->getId()]) }}" class="btn btn-sm float-end">Cancel</a>
    </div>
</form>
@endsection
 
