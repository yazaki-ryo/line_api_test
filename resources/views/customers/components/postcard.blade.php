@set ($field, 'mode')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ('elements.words.output')@lang ("elements.words.{$field}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Please select the setting registered by print setting.')"></span>
    </label>

    <div class="col-md-5">
        {!! Form::select($field, $printSettings, old($field, request($field, null)), ['required', 'class' => 'form-control', 'id' => $field, 'placeholder' => __('Please select')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ route('customers.postcards.export') }}" class="btn btn-primary" onclick="submitPostcardsForm('{{ route('customers.postcards.export') }}', 'selection'); return false;">
            @lang ('elements.words.pdf')@lang ('elements.words.export')
            <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Please select the destination customer from the list.')"></span>
        </a>
        <button type="button" class="btn btn-default" disabled>
            @lang ('elements.words.preview')
            <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Preview can be displayed with a postcard background.')"></span>
        </button>
        <p>
            <code>@lang ('Data that does not satisfy the output condition is automatically excluded.')</code>
        </p>
    </div>
</div>
