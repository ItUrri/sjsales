@extends('new_layout')
@section('title')
    {{ __('User :email', ['email' => $entity->getEmail()]) }}
@endsection

