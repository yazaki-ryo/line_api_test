<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6 form-bottom">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
        <v-btn flat icon color="dark" @click="function(event) { callback.textClearButtonTapped(event); }" v-bind:style="{position:'absolute', top: 0, right:0, margin:'0 1em 0 0', }">
          <v-icon>cancel</v-icon>
        </v-btn>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
    <div id="customer-chooser">
      <n-customer-chooser 
        v-on:select="function(selectedCustomer) { callback.customerSelected(selectedCustomer); }"
        linked_value_element="#{{ $attribute }}"
        title="{{ __('attributes.reservations.customer_search') }}"
        caption_button_trigger="{{ __('elements.words.search') }}"
        caption_button_search="{{ __('elements.words.search') }}"
        caption_button_close="{{ __('elements.words.close') }}"
        caption_button_done="{{ __('elements.words.select') }}"
        caption_text_free_word="{{ __('attributes.customers.search.free_word') }}"
        caption_label_tel="{{ __('attributes.customers.tel') }}"
        caption_label_mobile_phone="{{ __('attributes.customers.mobile_phone') }}"
        caption_label_email="{{ __('attributes.customers.email') }}"
        caption_label_data_empty="{{ __('Search result is empty.') }}"
        placeholder_free_word="{{ __('Name, office name, features, etc.') }}"
      ></n-customer-chooser>
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'reserved_date') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="date" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : (empty($row->reservedAt()) ? null : $row->reservedAt()->format('Y-m-d')) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'reserved_time') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="time" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : (empty($row->reservedAt()) ? null : $row->reservedAt()->format('H:i')) }}" class="form-control" id="{{ $attribute }}" maxlength="5" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'amount') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'seat') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-5">
        <select name="{{ $attribute }}" class="form-control p-region-id" id="{{ $attribute }}">
            <option value>@lang ('Please select')</option>
            @foreach ($seats as $item)
                <option value="{{ $item->id() }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null) === $item->id() ? 'selected' : '' }} >{{ $item->name() }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'reservation_code') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div> --}}

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'floor') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-6">
        <select name="{{ $attribute }}" class="form-control p-floor-id" id="{{ $attribute }}" disabled {{ $errors->{$errorBag ?? 'default'}->has($attribute_opt = 'seat') ? ' has-error' : '' }}>
            <option value>@lang ('Please select')</option>
            @foreach ($seats as $item)
                <option value="{{ $item->id() }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute_opt)}() ?? null) === $item->id() ? 'selected' : '' }}>{{ $item->floor() }}</option>
            @endforeach
        </select>
    {{--
        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    --}}
    </div>
</div>

{{-- <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'status') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6 form-control-static">

        <input type="tel" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />

        TODO status
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div> --}}

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'note') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.reservations.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$camel = camel_case($attribute)}() ?? null }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.reservations.%s', $attribute))
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
            @can ('authorize', config('permissions.groups.reservations.create'))
                <button type="submit" class="btn btn-primary" onclick="reservationForm.confirmCreateCustomer(); return false;">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', config('permissions.groups.reservations.update'))
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', config('permissions.groups.reservations.delete'))
                @can ('delete', $row)
                    <a href="{{ route('reservations.delete', $row->id()) }}" class="btn btn-danger" onclick="common.submitFormWithConfirm('{{ route('reservations.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
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
