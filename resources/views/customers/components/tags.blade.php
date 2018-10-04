<div class="form-group{{ $errors->has($attribute = 'tags') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('elements.words.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        @forelse ($tags as $group)
            @foreach ($group as $tag)
                <label>
                    <input type="checkbox" name="{{ sprintf('%s[]', $attribute) }}" value="{{ $tag->id() }}" {{ !empty(old($attribute)) ? (in_array($tag->id(), old($attribute)) ? 'checked' : '') : ($tagIds->containsStrict(function ($item) use ($tag) { return $item->id() === $tag->id(); }) ? 'checked' : '') }} />
                    <span class="label label-{{ $tag->label() }}">{{ $tag->name() }}</span>&nbsp;&nbsp;
                </label>

                @if ($loop->last && ! $loop->parent->last)
                    <br>
                @endif
            @endforeach
        @empty
            <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tags'), __('elements.words.data'))])</p>
        @endforelse

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.tags.update'))
            <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
        @endcan
    </div>
</div>
