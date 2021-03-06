<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'csv_file') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.files.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6 form-control-static">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /><!-- TODO from config file. -->
        {!! Form::file($attribute, null, ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>
<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.customers.test')){{-- TODO --}}
            <button type="submit" class="btn btn-primary">
                @lang ('elements.words.csv')@lang ('elements.words.import')
            </button>
        @endcan
    </div>
</div>
