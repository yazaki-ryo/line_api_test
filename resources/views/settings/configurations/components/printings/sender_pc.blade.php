@set ($field, "sender_flag_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_flag")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output information of sender such as zip code, address, name etc.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="1" required checked /> @lang ("elements.labels.yes")
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="0" required {{ (string)old($field, request($field, $row->{$field} ?? null)) === '0' ? 'checked' : '' }} /> @lang ("elements.labels.no")
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "sender_pc_symbol_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_pc_symbol")
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="1" required checked /> @lang ("elements.labels.yes")
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="0" required {{ (string)old($field, request($field, $row->{$field} ?? null)) === '0' ? 'checked' : '' }} /> @lang ("elements.labels.no")
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "sender_pc_x_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_pc_x")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? 15)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "sender_pc_y_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_pc_y")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? 40)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "sender_pc_font_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_pc_font")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fonts, old($field, request($field, $row->{$field} ?? 'gothic')), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "sender_pc_font_size_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.sender_pc_font_size")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $font_sizes, old($field, request($field, $row->{$field} ?? 10)), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
