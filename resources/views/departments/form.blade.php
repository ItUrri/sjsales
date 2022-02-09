@extends('cpanel_layout')
 
@section('content')
<h3>Edit department {{$entity->getName()}}</h3>
   
    {{ Form::open([
        'route' => 'departments.store', 
        'method' => 'POST', 
        'class' => '',
        'novalidate' => true,
    ]) }}

    <div class="mb-3 has-validations">
        {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
        {{ Form::text('name', $entity->getName(), ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' :'')]) }}
        @if ($errors->has('name'))
           <div class="invalid-feedback">{!! $errors->first('name') !!}</div>
        @endif
    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}

    {{ Form::close() }}
   
@endsection
