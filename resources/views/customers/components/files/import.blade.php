@set ($attribute, 'csv_file')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.files.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        {!! Form::file($attribute, null, ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! Form::hidden('MAX_FILE_SIZE', 2097152) !!}<!-- いずれ設定値から取得 -->
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
