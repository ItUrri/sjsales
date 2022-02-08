@extends('areas/header')

@section('body')
<h3>New order</h3>

    {{ Form::open([
        'route' => ['areas.orders.store', ['area' => $entity->getId()]], 
        'method' => 'POST', 
        'class' => 'row',
        'novalidate' => true,
       ])
    }}

    <div class="col-md-6 mb-3 border">
        {{ Form::label('credit', 'Credit', ['class' => 'form-label']) }}
        <div class="input-group input-group-sm">
            {{ Form::number('credit', null, ['step' => '0.01', 'min' => 0, 'class' => 'form-control' . ($errors->has('credit') ? ' is-invalid':'') ]) }}
            <span class="input-group-text">€</span>
            @if ($errors->has('credit'))
               <div class="invalid-feedback">{!! $errors->first('credit') !!}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6 mb-3 border">
        {{ Form::label('detail', 'Detail', ['class' => 'form-label']) }}
        {{ Form::textarea('detail', null, ['class' => 'form-control form-control-sm', 'rows' => 4]) }}
        @if ($errors->has('detail'))
           <div>{!! $errors->first('detail') !!}</div>
        @endif
    </div>

    <fieldset class="col-md-12 mb-3 collection-container" 
             data-prototype='@include("areas.orders.shared.form_product", ["index" => "__NAME__"])'>
        <legend>Contacts</legend>
        @foreach ($order->getProducts() as $i => $product)
            @include("areas.orders.shared.form_product", ["index" => $i])
        @endforeach
    </fieldset>

    <div class="col-md-12 border">
        <button type="button" class="add-to-collection btn btn-sm btn-default">New product</button>
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}
        <a href="{{ route('areas.show', ['area' => $entity->getId()]) }}" class="btn btn-sm float-end">Cancel</a>
    </div>

    {{ Form::close() }}

@endsection

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
