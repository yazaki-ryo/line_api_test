<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>
    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : (is_null($row->id()) ? sprintf('%s%s', __('elements.words.settings'), $key) : $row->{$camel = camel_case($attribute)}()) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

@include ('settings.printings.components.pc')

<hr>

@include ('settings.printings.components.address')

<hr>

@include ('settings.printings.components.name')

<hr>

@include ('settings.printings.components.from_pc')

<hr>

@include ('settings.printings.components.from_address')

<hr>

@include ('settings.printings.components.from_name')

<hr>

<div class="form-group">
    <div class="col-md-7 col-md-offset-5">
        @can ('authorize', 'self-settings.printings.update')
            <button type="submit" class="btn btn-primary">
                @lang ('elements.words.save')
            </button>
        @endcan

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
