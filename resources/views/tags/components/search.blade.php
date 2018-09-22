@set ($attribute, 'free_word')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.tags.search.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute1, 'visited_date_s')
@set ($attribute2, 'visited_date_e')
<div class="form-group{{ $errors->has($attribute1) || $errors->has($attribute2) ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ("attributes.tags.visited_histories.visited_date")
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute1, old($attribute1, request($attribute1)), ['class' => 'form-control', 'id' => $attribute1, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.start'), __('elements.words.day'))]) !!}
        {!! $errors->first($attribute1, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <div class="col-md-3">
        {!! Form::tel($attribute2, old($attribute2, request($attribute2)), ['class' => 'form-control', 'id' => $attribute2, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.end'), __('elements.words.day'))]) !!}
        {!! $errors->first($attribute2, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'mourning_flag')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.tags.search.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, array_reverse(\Lang::get('attributes.yes_or_no')), old($attribute, request($attribute)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'trashed')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.tags.search.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {!! Form::select($attribute, \Lang::get('attributes.trashed'), old($attribute, request($attribute)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
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
