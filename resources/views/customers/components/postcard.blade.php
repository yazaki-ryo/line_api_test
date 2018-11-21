<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'setting') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.postcards.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Please select the setting registered by print setting.')"></span>
    </label>

    <div class="col-md-5">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            <option value>@lang ('Please select')</option>
            @foreach ($printSettings as $key => $item)
                <option value="{{ $key }}" {{ (int)old($attribute) === (int)$key ? 'selected' : '' }} >{{ $item->name() }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'selection') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label"></label>

    <div class="col-md-5">
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'mode') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label"></label>

    <div class="col-md-5">
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.customers.postcards.export'))
            <a href="{{ route('customers.postcards.export') }}" class="btn btn-primary" id="export-link" target="_blank">
                @lang ('elements.words.pdf')@lang ('elements.words.export')
                <i class="fa fa-external-link-alt"></i>
            </a>

            <a href="{{ route('customers.postcards.export') }}" class="btn btn-default" id="preview-link" target="_blank">
                @lang ('elements.words.preview')
                <i class="fa fa-external-link-alt"></i>
                <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Preview can be displayed with a postcard background.')"></span>
            </a>
        @endcan

        <p>
            <code>@lang ('elements.words.komejirushi')@lang ('Please select the destination customer from the list.')</code>
            <br>
            <code>@lang ('elements.words.komejirushi')@lang ('Data that does not satisfy the output condition is automatically excluded.')</code>
        </p>
    </div>
</div>
