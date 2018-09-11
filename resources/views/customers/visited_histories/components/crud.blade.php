@set ($field, 'visited_date')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3 form-control-static">
        {!! Form::tel($field, old($field, request($field, empty($row->visitedAt()) ? null : $row->visitedAt()->format('Y-m-d'))), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 10, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'visited_time')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$field}")
    </label>

    <div class="col-md-3 form-control-static">
        {!! Form::time($field, old($field, request($field, empty($row->visitedAt()) ? null : $row->visitedAt()->format('H:i'))), ['class' => 'form-control', 'id' => $field, 'maxlength' => 5, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'amount')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$field}")
    </label>

    <div class="col-md-3 form-control-static">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 10, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'seat')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$field}")
    </label>

    <div class="col-md-5 form-control-static">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', ['customers.*', 'customers.visited_histories.create'])
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', ['customers.*', 'customers.visited_histories.update'])
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', ['customers.*', 'customers.visited_histories.delete'])
                @can ('delete', $row)
                    <a href="{{ route('customers.visited_histories.delete', [$row->customerId(), $row->id()]) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('customers.visited_histories.delete', [$row->customerId(), $row->id()]) }}'); return false;">
                        @lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif
    </div>
</div>
