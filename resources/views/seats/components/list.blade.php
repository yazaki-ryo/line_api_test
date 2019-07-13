<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="seats-table" class="table table-striped table-hover table-condensed table-bordered dt-responsive nowrap dataTable dtr-inline">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('elements.words.seats')</th>
                <th class="text-center">@lang ('elements.words.floor')</th>
                <th class="text-center">@lang ('elements.words.created')@lang ('elements.words.datetime')</th>
                <th class="text-center">@lang ('elements.words.updated')@lang ('elements.words.datetime')</th>
                <th class="text-center">@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td class="text-center">
                        <div class="checkbox">
                            <label><input type="checkbox" name="{{ $attribute = 'selection' }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($attribute))) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-left">{{ $row->{$camel = camel_case('name')}() }}</td>
                    <td class="text-center">{{ $row->floor() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('created_at')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('updated_at')}() }}</td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                        @if (! $row->{$camel = camel_case('deleted_at')}())
                            <li>
                                <a href="{{ route('seats.edit', $row->id()) }}">
                                    <i class="fas fa-pencil-alt icon-edit" title="@lang('elements.words.detail')"></i>
                                </a>
                            </li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('seats.delete', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('seats.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
                                    <i class="fas fa-trash-alt icon-delete" title="@lang('elements.words.delete')"></i>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tags'), __('elements.words.data'))])</p>
@endif
