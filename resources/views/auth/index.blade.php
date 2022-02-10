@extends('layout')

@section('content')
    <div class="row">
    {{ Form::open([
        'route' => 'login', 
        'method' => 'POST', 
        'class' => 'col-md-6 border',
        'novalidate' => true,
       ])
    }}

        {{ Form::label('email', 'Email', ['class' => 'form-label']) }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', 'Password', ['class' => 'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control']) }}

        {{ Form::submit('Login', ['class' => 'btn btn-sm btn-success float-end']) }}

    {{ Form::close() }}

    {{ Form::open([
        'route' => 'register', 
        'method' => 'POST', 
        'class' => 'col-md-6 border',
        'novalidate' => true,
       ])
    }}

        {{ Form::label('email', 'Email', ['class' => 'form-label']) }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', 'Password', ['class' => 'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control']) }}

        {{ Form::submit('register', ['class' => 'btn btn-sm btn-success float-end']) }}

    {{ Form::close() }}
    </div>
@endsection
