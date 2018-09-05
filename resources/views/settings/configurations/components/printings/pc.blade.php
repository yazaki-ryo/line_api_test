@set ($attribute, 'pc_position')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the postal code to the prescribed position or to the arbitrary position.')"></span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $positions, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_frame')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('When outputting the postal code to the prescribed position on the upper right, it is possible to select whether or not to output the frame.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="0" required checked /> @lang ("elements.labels.no")
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="1" required {{ (bool)old($field, request($field, $row->{$field} ?? $defaults[$attribute])) === true ? 'checked' : '' }} /> @lang ("elements.labels.yes")
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_symbol')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the 〒 mark when you want to output the postal code to an arbitrary position.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="1" required checked /> @lang ("elements.labels.yes")
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="0" required {{ (bool)old($field, request($field, $row->{$field} ?? $defaults[$attribute])) === false ? 'checked' : '' }} /> @lang ("elements.labels.no")
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_x')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_y')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_font')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fonttypes, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_font_size')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fontsizes, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
