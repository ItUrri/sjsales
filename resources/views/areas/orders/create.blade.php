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
        {{ Form::label('credit', 'Estimated credit', ['class' => 'form-label']) }}
        <div class="input-group input-group-sm mb-3">
            {{ Form::number('credit', null, ['step' => '0.01', 'min' => 0, 'class' => 'form-control' . ($errors->has('credit') ? ' is-invalid':'') ]) }}
            <span class="input-group-text">€</span>
            @if ($errors->has('credit'))
               <div class="invalid-feedback">{!! $errors->first('credit') !!}</div>
            @endif
        </div>

        {{ Form::label('custom', 'Intercalate', ['class' => 'form-label']) }}
        {{ Form::checkbox("custom", null, false, ['class' => 'form-check-input', 'onchange' => 'displayCustom(this)']) }}         
        <div id="custom-fields" class="row d-none">
            <div class="col-md-12 text-center small" id="sequence-alert"></div>
            <div class="col-md-4 border">
                {{ Form::label('previous', 'Select previous', ['class' => 'form-label']) }}
                {{ Form::select('previous', array_merge([null => '--Select one--'], $entity->getOrders()->map(function($e) {return $e->getSequence(); })->toArray()), null, ['class'=>'form-select form-select-sm', 'disabled' => true, 'onchange' => 'selectSequence(this)'], [null => ['disabled' => true]]) }}
            </div>
            <div class="col-md-4 border">
                {{ Form::label('sequence', 'Current sequence', ['class' => 'form-label']) }}
                {{ Form::text("sequence", null, ['class' => 'form-control form-control-sm', 'disabled' => true]) }}
                @if ($errors->has('sequence'))
                   <div>{!! $errors->first('sequence') !!}</div>
                @endif
            </div>
            <div class="col-md-4 border">
                {{ Form::label('date', 'Date', ['class' => 'form-label']) }}
                {{ Form::date("date", now(), ['class' => 'form-control form-control-sm', 'disabled' => true]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3 border">
        {{ Form::label('estimated', 'Presupuesto', ['class' => 'form-label']) }}
        {{ Form::file("estimated", ['class' => 'form-control form-control-sm']) }}
        @if ($errors->has('estimated'))
           <div>{!! $errors->first('estimated') !!}</div>
        @endif
        {{ Form::label('detail', 'Detail', ['class' => 'form-label']) }}
        {{ Form::textarea('detail', null, ['class' => 'form-control form-control-sm', 'rows' => 2]) }}
        @if ($errors->has('detail'))
           <div>{!! $errors->first('detail') !!}</div>
        @endif
    </div>

    <fieldset class="col-md-12 mb-3 collection-container" 
             data-prototype='@include("areas.orders.shared.form_product", ["index" => "__NAME__"])'>
        <legend>Products</legend>
        @foreach ($order->getProducts() as $i => $product)
            @include("areas.orders.shared.form_product", ["index" => $i])
        @endforeach
    </fieldset>

    <div class="col-md-12 border">
        <button type="button" class="btn btn-sm btn-default" onclick="addToCollection()">New product</button>
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-success float-end']) }}
        <a href="{{ route('areas.show', ['area' => $entity->getId()]) }}" class="btn btn-sm float-end">Cancel</a>
    </div>

    {{ Form::close() }}

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
        function addToCollection(btn) {
            var container = $('.collection-container');
            var count = container.children().length;
            var proto = container.data('prototype').replace(/__NAME__/g, count);
            container.append(proto);
        }

        function rmCollection(btn) {
            btn.closest('div').remove();
        }

        function displayCustom(input) {
            if ($(input).prop('checked')) {
                $('#custom-fields').removeClass('d-none');
                $('#custom-fields :input').each(function() {
                    $(this).attr('disabled', false);
                });
            }
            else {
                $('#custom-fields').addClass('d-none');
                $('#custom-fields :input').each(function() {
                    $(this).attr('disabled', true)
                           //.val(null)
                           ;
                });
            } 
        }

        var sequence = @php echo json_encode($entity->getOrders()->toArray()); @endphp;
        function selectSequence(input) {
            var index = $(input).val();
            var prev = sequence[index];
            $('#sequence:input').val(prev.sequence + "-1");
            $('#date:input').val(prev.date);
            if (index < sequence.length-1) var next = sequence[index++].date;
            else var next = new Date(); 
            var msg = "Date must be between " + prev.date + " and " + next;
            $('#sequence-alert').html(msg);
        }

        $(document).ready(function() {
            displayCustom($('#custom:input'));
        });
    </script>
@endsection
