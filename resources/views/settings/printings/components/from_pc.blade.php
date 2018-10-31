<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_flag') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output information of sender such as zip code, address, name etc.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        @foreach (\Lang::get('attributes.yes_or_no') as $key => $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $key }}" required {{ (bool)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === (bool)$key ? 'checked' : ((bool)$key === true ?  'checked' : '') }} /> {{ $item }}
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_pc_symbol') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
    </label>

    <div class="col-md-7 form-control-static">
        @foreach (\Lang::get('attributes.yes_or_no') as $key => $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $key }}" required {{ (bool)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === (bool)$key ? 'checked' : ((bool)$key === true ?  'checked' : '') }} /> {{ $item }}
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_pc_x') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_pc_y') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute] }}" class="form-control" id="{{ $attribute }}" maxlength="3" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_pc_font') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fonttypes as $key => $item)
                <option value="{{ $key }}" {{ ($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'from_pc_font_size') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang (sprintf('attributes.settings.printings.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" required>
            @foreach ($fontsizes as $key => $item)
                <option value="{{ $key }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? $defaults[$attribute]) === (int)$key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>
