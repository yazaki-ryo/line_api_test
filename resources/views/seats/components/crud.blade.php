<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.seats.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'floor') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.seats.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-2 form-control-static">
        <input type="number" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" min="1" max="100" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.seats.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        </div>
    </div>
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
        @elseif ($mode === 'edit')
            <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
            <a href="{{ route('seats.delete', $row->id()) }}" class="btn btn-danger" onclick="common.submitFormWithConfirm('{{ route('seats.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
                <i class="fa fa-trash"></i>@lang ('elements.words.delete')
            </a>
        @endif

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
