@set ($attribute, 'visited_date')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, empty($row->visitedAt()) ? null : $row->visitedAt()->format('Y-m-d'))), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 10, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'visited_time')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$attribute}")
    </label>

    <div class="col-md-3">
        {!! Form::time($attribute, old($attribute, request($attribute, empty($row->visitedAt()) ? null : $row->visitedAt()->format('H:i'))), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 5, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'amount')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$attribute}")
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 10, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'seat')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.visited_histories.{$attribute}")
    </label>

    <div class="col-md-5">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
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

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
