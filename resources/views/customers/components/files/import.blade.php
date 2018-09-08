@set ($field, 'csv_file')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.files.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        {!! Form::file($field, null, ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! Form::hidden('MAX_FILE_SIZE', 2097152) !!}<!-- いずれ設定値から取得 -->
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.words.csv')@lang ('elements.words.import')
        </button>
    </div>
</div>
