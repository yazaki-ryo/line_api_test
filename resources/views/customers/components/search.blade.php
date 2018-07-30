@set ($field, 'free_word')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'trashed')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("elements.labels.{$field}")
    </label>

    <div class="col-md-6">
        <label>
            <input type="radio" name="{{ $field }}" value="1" required checked /> @lang ("elements.labels.{$field}")@lang ('elements.labels.state.without')
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="2" required {{ (int)old($field, request($field)) === 2 ? 'checked' : '' }} /> @lang ("elements.labels.{$field}")@lang ('elements.labels.state.with')
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="3" required {{ (int)old($field, request($field)) === 3 ? 'checked' : '' }} /> @lang ("elements.labels.{$field}")@lang ('elements.labels.state.only')
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-info">
            @lang ('elements.actions.search')
        </button>
    </div>
</div>
