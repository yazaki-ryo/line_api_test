@set ($field, 'mode')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ('elements.actions.output')@lang ("elements.labels.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            @set ($value, 'new_year_card')
            <input type="radio" name="{{ $field }}" value="{{ $value }}" required checked /> @lang ("elements.postcards.{$value}")
        </label>
        <label>
            @set ($value, 'summer_greeting_card')
            <input type="radio" name="{{ $field }}" value="{{ $value }}" required {{ !empty(old($field)) && old($field) === $value || request()->has($field) && request($field) === $value ? 'checked' : '' }} /> @lang ("elements.postcards.{$value}")
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ route('customers.postcards.export') }}" class="btn btn-primary" onclick="submitPostcardsForm('{{ route('customers.postcards.export') }}', 'selection'); return false;">
            @lang ('elements.labels.pdf')@lang ('elements.actions.export')
        </a>
        <button type="button" class="btn btn-default" disabled>
            @lang ('elements.labels.preview')
            <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Preview can be displayed with a postcard background.')"></span>
        </button>
    </div>
</div>
