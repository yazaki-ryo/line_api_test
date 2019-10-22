<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'selection') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label"></label>

    <div class="col-md-5">
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
