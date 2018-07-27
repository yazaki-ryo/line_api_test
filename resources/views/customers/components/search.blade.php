@set ($field, 'free_word')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-warning">
            @lang ('elements.buttons.search')
        </button>
    </div>
</div>
