<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.tags.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'label') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.tags.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6 form-control-static">
        @foreach (config('tags.labels') as $key => $item)
            <div><label><input type="radio" name="{{ $attribute }}" value="{{ $key }}" {{ ($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null) === $key ? 'checked' : ($key === 'default' ? 'checked' : '') }} /> <span class="label label-{{ $key }}">{{ $item }}</span></label></div>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.tags.%s', $attribute))
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
            @can ('authorize', config('permissions.groups.tags.create'))
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', config('permissions.groups.tags.update'))
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', config('permissions.groups.tags.delete'))
                @can ('delete', $row)
                    <a href="{{ route('tags.delete', $row->id()) }}" class="btn btn-danger" onclick="common.submitFormWithConfirm('{{ route('tags.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
                        <i class="fa fa-trash"></i>@lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
