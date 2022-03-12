@extends('new_layout')
@section('title'){{ __('Orders') }}@endsection
@section('btn-toolbar')
@endsection
@section('content')

<form action="" method="GET" class="row mb-3">
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm bg-danger">Email</label>
      <div class="col-sm-2 bg-info">
        <input type="date" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
      </div>
      <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm bg-danger">Email</label>
      <div class="col-sm-2 bg-info">
        <input type="date" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
      </div>
      <div class="col-sm-2 bg-dark">
        <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
      </div>
      <div class="col-sm-2 bg-warning">
        <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
      </div>
      <div class="col-sm bg-secondary">
          {{ Form::button('<span data-feather="search"></span>', ['class' => 'btn btn-sm btn-primary float-end', 'type' => 'sybmit']) }}
      </div>
</form>


@include('orders.shared.table', ['collection' => $collection, 'pagination' => true])
  
@endsection
