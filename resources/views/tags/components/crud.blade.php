@set ($field, 'name')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.tags.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'label')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.tags.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($labels as $key => $item)
            <div><label><input type="radio" name="{{ $field }}" value="{{ $key }}" {{ old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)) === $key ? 'checked' : ($key === 'default' ? 'checked' : '') }} /> <span class="label label-{{ $key }}">{{ $item }}</span></label></div>
        @endforeach

        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'updated_at')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
        <label for="{{ $field }}" class="col-md-4 control-label">
            @lang ("attributes.tags.{$field}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ $row->{$camel = camel_case($field)}() ?? null }}
            {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
        </div>
    </div>
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', ['tags.*', 'tags.create'])
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', ['tags.*', 'tags.update'])
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', ['tags.*', 'tags.delete'])
                @can ('delete', $row)
                    <a href="{{ route('tags.delete', $row->id()) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('tags.delete', $row->id()) }}'); return false;">
                        <i class="fa fa-trash"></i>@lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif
    </div>
</div>
