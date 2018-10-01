@set ($attribute, 'mode')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ('elements.words.output')@lang ("elements.words.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Please select the setting registered by print setting.')"></span>
    </label>

    <div class="col-md-5">
        {!! Form::select($attribute, $printSettings, old($attribute, request($attribute, null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.customers.postcards.export'))
            <a href="{{ route('customers.postcards.export') }}" class="btn btn-primary" onclick="submitPostcardsForm('{{ route('customers.postcards.export') }}', 'selection'); return false;">
                @lang ('elements.words.pdf')@lang ('elements.words.export')
                <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Please select the destination customer from the list.')"></span>
            </a>

            <button type="button" class="btn btn-default" disabled>
                @lang ('elements.words.preview')
                <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('Preview can be displayed with a postcard background.')"></span>
            </button>
        @endcan

        <p>
            <code>@lang ('Data that does not satisfy the output condition is automatically excluded.')</code>
        </p>
    </div>
</div>
