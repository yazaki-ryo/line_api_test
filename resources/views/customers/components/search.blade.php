@set ($field1, 'visited_date_s')
@set ($field2, 'visited_date_e')
<div class="form-group{{ $errors->has($field1) || $errors->has($field2) ? ' has-error' : '' }}">
    <label for="{{ $field1 }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.visited_date")
    </label>

    <div class="col-md-3">
        {!! Form::tel($field1, old($field1, request($field1)), ['class' => 'form-control', 'id' => $field1, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.start'), __('elements.words.day'))]) !!}
        {!! $errors->first($field1, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <div class="col-md-3">
        {!! Form::tel($field2, old($field2, request($field2)), ['class' => 'form-control', 'id' => $field2, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.end'), __('elements.words.day'))]) !!}
        {!! $errors->first($field2, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'free_word')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.search.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'trashed')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.search.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="1" required checked /> @lang ("elements.words.{$field}")@lang ('elements.words.state.without')
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="2" required {{ (int)old($field, request($field)) === 2 ? 'checked' : '' }} /> @lang ("elements.words.{$field}")@lang ('elements.words.state.with')
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="3" required {{ (int)old($field, request($field)) === 3 ? 'checked' : '' }} /> @lang ("elements.words.{$field}")@lang ('elements.words.state.only')
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-info">
            @lang ('elements.words.search')
        </button>
    </div>
</div>
