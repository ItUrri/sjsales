@extends('suppliers/header')
 
@section('body')
   
    {{ Form::open([
        'route' => ['suppliers.update', 'supplier' => $entity->getId()],
        'method' => 'PUT', 
        'class' => 'row',
        'novalidate' => true,
    ]) }}

    <div class="col-md-6 mb-3 has-validations">
        {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
        {{ Form::text('name', $entity->getName(), ['class' => 'form-control form-control-sm' . ($errors->has('name') ? ' is-invalid' :'')]) }}
        @if ($errors->has('name'))
           <div class="invalid-feedback">{!! $errors->first('name') !!}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3 has-validations">
        {{ Form::label('nif', 'NIF', ['class' => 'form-label']) }}
        {{ Form::number('nif', $entity->getNif(), ['class' => 'form-control form-control-sm' . ($errors->has('nif') ? ' is-invalid' :'')]) }}
        @if ($errors->has('nif'))
           <div class="invalid-feedback">{!! $errors->first('nif') !!}</div>
        @endif
    </div>

    <div class="col-md-3 mb-3 has-validations">
        {{ Form::label('zip', 'ZIP code', ['class' => 'form-label']) }}
        {{ Form::number('zip', $entity->getZip(), ['class' => 'form-control form-control-sm' . ($errors->has('zip') ? ' is-invalid' :'')]) }}
        @if ($errors->has('zip'))
           <div class="invalid-feedback">{!! $errors->first('zip') !!}</div>
        @endif
    </div>

    <div class="col-md-3 mb-3 has-validations">
        {{ Form::label('city', 'City', ['class' => 'form-label']) }}
        {{ Form::text('city', $entity->getCity(), ['class' => 'form-control form-control-sm' . ($errors->has('city') ? ' is-invalid' :'')]) }}
        @if ($errors->has('city'))
           <div class="invalid-feedback">{!! $errors->first('city') !!}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3 has-validations">
        {{ Form::label('address', 'Address', ['class' => 'form-label']) }}
        {{ Form::text('address', $entity->getAddress(), ['class' => 'form-control form-control-sm' . ($errors->has('address') ? ' is-invalid' :'')]) }}
        @if ($errors->has('address'))
           <div class="invalid-feedback">{!! $errors->first('address') !!}</div>
        @endif
    </div>

    <div class="col-md-12 mb-3 has-validations">
        {{ Form::checkbox('acceptable', true, $entity->getAcceptable(), ['class' => 'form-check-input' . ($errors->has('acceptable') ? ' is-invalid' :'')]) }}
        {{ Form::label("acceptable", "Acceptable", ['class' => 'form-check-label']) }}
        @if ($errors->has('acceptable'))
           <div class="invalid-feedback">{!! $errors->first('acceptable') !!}</div>
        @endif
        {{ Form::checkbox('recommendable', true, $entity->getRecommendable(), ['class' => 'form-check-input' . ($errors->has('recommendable') ? ' is-invalid' :'')]) }}
        {{ Form::label("recommendable", "recommendable", ['class' => 'form-check-label']) }}
        @if ($errors->has('recommendable'))
           <div class="invalid-feedback">{!! $errors->first('recommendable') !!}</div>
        @endif
    </div>
   
    <div class="col-md-12 mb-3">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}
        <a href="{{ route('suppliers.show', ['supplier' => $entity->getId()]) }}" class="btn btn-sm btn-default">Cancel</a>
    </div>

    {{ Form::close() }}

@endsection
