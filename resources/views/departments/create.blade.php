@extends('cpanel_layout')
 
@section('content')
    <h3>New department</h3>
   
    {{ Form::open([
        'route' => 'departments.store', 
        'method' => 'POST', 
        'class' => '',
        'novalidate' => true,
    ]) }}

    <div class="mb-3 has-validations">
        {{ Form::label('name', 'Department name', ['class' => 'form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' :'')]) }}
        @if ($errors->has('name'))
           <div class="invalid-feedback">{!! $errors->first('name') !!}</div>
        @endif
    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}

    {{ Form::close() }}

@endsection
