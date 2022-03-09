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
        {{ Form::email('email', null, ['class' => 'form-control' . ($errors->has('email')? ' is-invalid':'')]) }}
        @if ($errors->has('email'))
           <div class="invalid-feedback">{!! $errors->first('email') !!}</div>
        @endif

        {{ Form::label('password', 'Password', ['class' => 'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid':'')]) }}
        @if ($errors->has('password'))
           <div class="invalid-feedback">{!! $errors->first('password') !!}</div>
        @endif

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
        {{ Form::email('email', null, ['class' => 'form-control' . ($errors->has('email')? ' is-invalid':'')]) }}
        @if ($errors->has('email'))
           <div class="invalid-feedback">{!! $errors->first('email') !!}</div>
        @endif

        {{ Form::label('password', 'Password', ['class' => 'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid':'')]) }}
        @if ($errors->has('password'))
           <div class="invalid-feedback">{!! $errors->first('password') !!}</div>
        @endif
        {{ Form::submit('register', ['class' => 'btn btn-sm btn-success float-end']) }}

    {{ Form::close() }}
    </div>

    <a href="{{ route('redirectToProvider') }}">Google</a>
@endsection
