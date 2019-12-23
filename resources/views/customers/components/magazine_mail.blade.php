<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'title') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-2 control-label">
        @lang (sprintf('attributes.customers.magazines.%s', $attribute))
    </label>

    <div class="col-md-8">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : '' }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'content') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-2 control-label">
        @lang (sprintf('attributes.customers.magazines.%s', $attribute))
    </label>

    <div class="col-md-8 input-mail-content">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="7" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.customers.postcards.export'))
            <button type="button" class="btn btn-primary" onclick="if (confirm('@lang ('Are you sure send mail selected customer(s)?')')) { mailSelectedCustomers(); }">
                @lang ('elements.words.mail')@lang ('elements.words.send')
                <i class="fa fa-external-link-alt"></i>
            </button>
        @endcan
    </div>
</div>
