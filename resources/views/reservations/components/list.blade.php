<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="reservations-table" class="table table-striped table-hover table-condensed table-bordered dt-responsive nowrap dataTable dtr-inline">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('elements.words.name')</th>
                <th class="text-center">@lang ('elements.words.customers')@lang ('elements.words.num')</th>
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
                    <td class="text-left"><span class="label label-{{ $row->{$camel = camel_case('label')}() }}">{{ $row->{$camel = camel_case('name')}() }}</span></td>
                    <td class="text-center"><span class="badge">{{ $row->customers()->count() }}</span></td>
                    <td class="text-center">{{ $row->{$camel = camel_case('created_at')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('updated_at')}() }}</td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            @if (! $row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.reservations.select'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('reservations.edit', $row->id()) }}">
                                                <i class="fas fa-pencil-alt icon-edit" title="@lang('elements.words.detail')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.reservations.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('reservations.delete', $row->id()) }}" onclick="deleteRecord('{{ route('reservations.delete', $row->id()) }}'); return false;">
                                                <i class="fas fa-trash-alt icon-delete" title="@lang('elements.words.delete')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endcan
                            @endif
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.reservations'), __('elements.words.data'))])</p>
@endif
