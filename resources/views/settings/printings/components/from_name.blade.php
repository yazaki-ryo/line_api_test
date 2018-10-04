<div class="form-group{{ $errors->{$errorBag}->has($attribute = 'from_name_x') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag}->has($attribute = 'from_name_y') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag}->has($attribute = 'from_name_font') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fonttypes as $key => $item)
                <option value="{{ $key }}" {{ ($errors->{$errorBag}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag}->has($attribute = 'from_name_font_size') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fontsizes as $key => $item)
                <option value="{{ $key }}" {{ (int)($errors->{$errorBag}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === (int)$key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>
