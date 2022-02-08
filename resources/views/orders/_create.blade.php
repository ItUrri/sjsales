@extends('layout')
 
@section('sidebar')
    <a class="btn btn-sm w-100 btn-outline-primary" 
    href="{{ route('orders.index') }}">Cancel</a> 
@endsection

@section('content')
   
    {{ Form::open(['route' => 'orders.store', 'method' => 'POST']) }}

        {{ Form::label('Detail') }}
        {{ Form::text('detail') }}
        @if ($errors->has('detail'))
           <p>{!! $errors->first('detail') !!}</p>
        @endif

        <div class="collection-container" 
             data-prototype="
<div class='form-group'>
        <div class='form-group'>
            <label for='products[__NAME__][detail]'>detail</label>
            <input type='text' id='products[__NAME__][detail]' class='form-control' name='products[__NAME__][detail]'>
        </div>
        <div class='form-group'>
            <label for='products[__NAME__][total]'>total</label>
            <input type='number' id='products[__NAME__][total]' class='form-control' name='products[__NAME__][total]'>
        </div>
        <button type='button' onclick='rmCollection(this)'>X</button>
    </div>
            ">
        </div>

        <button type="button" class="add-to-collection">Add</button>
        {{ Form::submit('Save') }}

    {{ Form::close() }}

@endsection

<!--
-->
@section('scripts')
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-collection').on('click', function(e) {
                e.preventDefault();
                var container = $('.collection-container');
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, count);
                container.append(proto);
            });
        });

        function rmCollection(btn) {
            btn.closest('div').remove();
        }
    </script>
@endsection
