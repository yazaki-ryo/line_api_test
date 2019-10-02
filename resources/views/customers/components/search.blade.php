{{Form::hidden('tab', 'index')}}
<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'free_word') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.search.%s', $attribute))
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, Session::get($attribute), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 2, 'placeholder' => __('Name, office name, features, etc.')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute1 = 'visited_date_s') ? ' has-error' : '' }}{{ $errors->{$errorBag ?? 'default'}->has($attribute2 = 'visited_date_e') ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ('attributes.customers.visited_histories.visited_date')
    </label>

    <div class="col-md-3 form-bottom">
        {!! Form::date($attribute1, Session::get($attribute1), ['class' => 'form-control', 'id' => $attribute1, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.start'), __('elements.words.day'))]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3 form-bottom">
        {!! Form::date($attribute2, Session::get($attribute2), ['class' => 'form-control', 'id' => $attribute2, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.end'), __('elements.words.day'))]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute1 = 'birthday_s') ? ' has-error' : '' }}{{ $errors->{$errorBag ?? 'default'}->has($attribute2 = 'birthday_e') ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ('attributes.customers.birthday')
    </label>

    <div class="col-md-3 form-bottom">
        {!! Form::date($attribute1, Session::get($attribute1), ['class' => 'form-control', 'id' => $attribute1, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.start'), __('elements.words.day'))]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3 form-bottom">
        {!! Form::date($attribute2, Session::get($attribute2), ['class' => 'form-control', 'id' => $attribute2, 'maxlength' => 10, 'placeholder' => sprintf('%s%s%s', __('elements.words.search'), __('elements.words.end'), __('elements.words.day'))]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'mourning_flag') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.search.%s', $attribute))
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, array_reverse(\Lang::get('attributes.yes_or_no')), Session::get($attribute), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@can ('authorize', config('permissions.groups.customers.restore'))
    @can ('authorize', config('permissions.groups.customers.delete'))
        <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'trashed') ? ' has-error' : '' }}">
            <label for="{{ $attribute }}" class="col-md-4 control-label">
                @lang (sprintf('attributes.customers.search.%s', $attribute))
            </label>

            <div class="col-md-6 form-control-static">
                {!! Form::select($attribute, \Lang::get('attributes.trashed'), null, ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
                @include ('components.form.err_msg', ['attribute' => $attribute])
            </div>
        </div>
    @endcan
@endcan

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'tags') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('elements.words.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        @forelse ($tags as $group)
            @foreach ($group as $tag)
                <label>
                    <input type="checkbox" name="{{ sprintf('%s[]', $attribute) }}" value="{{ $tag->id() }}" {{ 
                        !empty(old($attribute)) 
                            ? (in_array($tag->id(), old($attribute)) ? 'checked' : '') 
                            : (
                                !empty(request($attribute)) 
                                        && is_array(request($attribute)) 
                                        && in_array($tag->id(), request($attribute)) 
                                    ? 'checked' 
                                    : (
                                        Session::has($attribute) 
                                                && is_array(Session::get($attribute)) 
                                                && in_array($tag->id(), Session::get($attribute)) 
                                            ? 'checked' : ''
                                    )
                            ) }} />
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
        @can ('authorize', config('permissions.groups.customers.select'))
            <button type="submit" name="searched" value="searched" class="btn btn-primary">
                @lang ('elements.words.search')
            </button>

            <span class="btn btn-default" onclick="if (confirm('@lang ('Do you want to reset the search conditions?')')) { common.clearForm(window.customers_search_form); window.customers_search_form.submit(); }">
                @lang ('elements.words.conditions')@lang ('elements.words.reset')
            </span>
        @endcan
    </div>
</div>
