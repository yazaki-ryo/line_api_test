<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_position') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the postal code to the prescribed position or to the arbitrary position.')"></span>
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($positions as $key => $item)
                <option value="{{ $key }}" {{ ($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? $defaults[$attribute]) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_frame') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('When outputting the postal code to the prescribed position on the upper right, it is possible to select whether or not to output the frame.')"></span>
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-7 form-control-static">
        @foreach (\Lang::get('attributes.yes_or_no') as $key => $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $key }}" required {{ (bool)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : optional($row->{$camel = camel_case($attribute)}())->asBoolean() ?? $defaults[$attribute]) === (bool)$key ? 'checked' : ((bool)$key === true ?  'checked' : '') }} /> {{ $item }}
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_symbol') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the 〒 mark when you want to output the postal code to an arbitrary position.')"></span>
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-7 form-control-static">
        @foreach (\Lang::get('attributes.yes_or_no') as $key => $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $key }}" required {{ (bool)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : optional($row->{$camel = camel_case($attribute)}())->asBoolean() ?? $defaults[$attribute]) === (bool)$key ? 'checked' : ((bool)$key === true ?  'checked' : '') }} /> {{ $item }}
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_x') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_y') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_font') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fonttypes as $key => $item)
                <option value="{{ $key }}" {{ ($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? $defaults[$attribute]) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'pc_font_size') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fontsizes as $key => $item)
                <option value="{{ $key }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? $defaults[$attribute]) === (int)$key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>
