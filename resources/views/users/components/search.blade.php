@set ($attribute, 'free_word')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.search.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'trashed')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.search.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {!! Form::select($attribute, \Lang::get('attributes.trashed'), old($attribute, request($attribute)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.users.select'))
            <button type="submit" class="btn btn-primary">
                @lang ('elements.words.search')
            </button>
        @endcan

        <a href="{{ route('users') }}" class="btn btn-default" onclick="if (! confirm('@lang ('Do you want to reset the search conditions?')')) return false;">
            @lang ('elements.words.conditions')@lang ('elements.words.reset')
        </a>
    </div>
</div>
