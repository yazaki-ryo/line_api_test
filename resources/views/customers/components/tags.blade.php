@set ($field, 'tags')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("elements.words.{$field}")
    </label>

    <div class="col-md-6">
        @forelse ($tags as $group)
            @foreach ($group as $tag)
                <label>
                    <input type="checkbox" name="{{ sprintf('%s[]', $field) }}" value="{{ $tag->id() }}" {{ !empty(old($field)) ? (in_array($tag->id(), old($field)) ? 'checked' : '') : ($tagIds->containsStrict(function ($item) use ($tag) { return $item->id() === $tag->id(); }) ? 'checked' : '') }} />
                    <span class="label label-{{ $tag->label() }}">{{ $tag->name() }}</span>&nbsp;&nbsp;
                </label>

                @if ($loop->last)
                    <hr>
                @endif
            @endforeach
        @empty
            <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tags'), __('elements.words.data'))])</p>
        @endforelse

        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', ['customers.*', 'customers.update'])
            <button type="submit" class="btn btn-default">@lang ('elements.words.save')</button>
        @endcan
    </div>
</div>
