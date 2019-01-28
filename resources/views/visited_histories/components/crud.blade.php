@if ($mode === 'add')
    <input type="hidden" name="customer_id" value="{{ $customer->id() }}" />
@endif

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'visited_date') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="date" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : (empty($row->visitedAt()) ? null : $row->visitedAt()->format('Y-m-d')) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'visited_time') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="time" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : (empty($row->visitedAt()) ? null : $row->visitedAt()->format('H:i')) }}" class="form-control" id="{{ $attribute }}" maxlength="5" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'amount') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'seat') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
    </label>

    <div class="col-md-5">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'note') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if (\Route::has('reservations.index'))<!-- TODO -->
    @if ($mode === 'edit')
        <div class="form-group">
            <label for="{{ $attribute = 'reservation' }}" class="col-md-4 control-label">
                @lang (sprintf('elements.words.%s', $attribute))
            </label>

            <div class="col-md-6 form-control-static">
                @if ($row->reservation())
                    <span class="text-success">@lang ('elements.words.yes')</span>
                @else
                    <span class="text-danger">@lang ('elements.words.no')</span>
                @endif
            </div>
        </div>
    @endif
@endif

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'attachment') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($row->attachments() as $attachment)
            @continue (! $attachment->name())

            <img src="{{ asset(str_finish('storage/' . $attachment->path(), '/') . $attachment->name()) }}" class="thumbnail" width="150" height="auto" alt="" />
        @endforeach

        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /><!-- TODO from config file. -->
        {!! Form::file($attribute, null, ['class' => 'form-control', 'id' => $attribute, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])

        @if ($row->attachments()->count())
            <div class="checkbox">
                <label>
                    {!! Form::checkbox($attribute2 = 'drop_attachment', 1, old($attribute2), ['class' => '', 'id' => $attribute2]) !!} @lang ('Delete the current image.')
                </label>

                @include ('components.form.err_msg', ['attribute' => $attribute2])
            </div>
        @endif
    </div>
</div>

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.visited_histories.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        </div>
    </div>
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', config('permissions.groups.customers.visited_histories.update'))
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', config('permissions.groups.customers.visited_histories.delete'))
                @can ('delete', $row)
                    <a href="{{ route('visited_histories.delete', $row->id()) }}" class="btn btn-danger" onclick="common.submitFormWithConfirm('{{ route('visited_histories.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
                        @lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
