@set ($field, 'mode')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ('elements.actions.output')
        @lang ("elements.labels.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="new_year_card" required checked /> @lang ('elements.postcards.new_year_card')
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="summer_greeting_card" required {{ (int)old($field, request($field)) === 2 ? 'checked' : '' }} /> @lang ('elements.postcards.summer_greeting_card')
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ route('customers.postcards.output') }}" class="btn btn-primary" onclick="submitPostcardsForm('{{ route('customers.postcards.output') }}', 'selection'); return false;">
            @lang ('elements.labels.pdf')
            @lang ('elements.actions.output')
        </a>
        <button type="button" class="btn btn-default" disabled>
            @lang ('elements.labels.preview')
            <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="tooltip" data-original-title="@lang ('Preview can be displayed with a postcard background.')"></span>
        </button>
    </div>
</div>
