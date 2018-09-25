@set ($attribute, 'name')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag}->any() ? old($attribute) : $row->{$attribute} ?? sprintf('%s%s', __('elements.words.settings'), $key) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
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
        <button type="submit" class="btn btn-primary">
            @lang ('elements.words.save')
        </button>

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
