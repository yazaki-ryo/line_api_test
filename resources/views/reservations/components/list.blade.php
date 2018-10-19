<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="reservations-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('attributes.reservations.name')</th>
                <th class="text-center">@lang ('attributes.reservations.reserved_date')</th>
                <th class="text-center">@lang ('attributes.reservations.reserved_time')</th>
                <th class="text-center">@lang ('attributes.reservations.amount')</th>
                <th class="text-center">@lang ('attributes.reservations.seat')</th>
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
                    <td class="text-center">{{ $row->{$camel = camel_case('name')}() }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('reserved_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('reserved_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('amount')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('seat')}() }}</td>
                    <td class="text-center dropdown">
                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @if (! $row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.reservations.select'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('reservations.edit', $row->id()) }}">
                                                @lang ('elements.words.detail')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @if ($row->{$camel = camel_case('customer_id')}() && is_null($row->visitedHistory()))
                                    @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                                        <li>
                                            <a href="{{ route('reservations.visited_histories.add', $row->id()) }}" onclick="test('{{ route('reservations.visited_histories.add', $row->id()) }}'); return false;">
                                                @lang ('elements.words.visit')@lang ('elements.words.register')
                                            </a>
                                        </li>
                                    @endcan
                                @endif

                                @can ('authorize', config('permissions.groups.reservations.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('reservations.delete', $row->id()) }}" onclick="deleteRecord('{{ route('reservations.delete', $row->id()) }}'); return false;">
                                                @lang ('elements.words.delete')
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
