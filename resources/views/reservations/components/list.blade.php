<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
<div class="table-responsive">
    <table id="reservations-table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid">
        <colgroup>
            <col width="3%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
            <col width="15%">
            <col width="25%">
        </colgroup>
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
                    <td class="text-center">
                        @if ($row->{$camel = camel_case('customer_id')}() && is_null($row->visitedHistory()))
                            @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                                <a href="{{ route('reservations.visited_histories.add', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('reservations.visited_histories.add', $row->id()) }}', '@lang ('Do you want to register this reservation information as visit information?')'); return false;" title="@lang ('elements.words.visit')@lang ('elements.words.register')">
                                    {{ $row->{$camel = camel_case('name')}() }}
                                </a>
                            @endcan
                        @else
                          {{ $row->{$camel = camel_case('name')}() }}
                        @endif
                    </td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('reserved_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('reserved_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('amount')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('seat')}() }}</td>
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

                                @if ($row->{$camel = camel_case('customer_id')}() && is_null($row->visitedHistory()))
                                    @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                                        <li>
                                            <a href="{{ route('reservations.visited_histories.add', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('reservations.visited_histories.add', $row->id()) }}', '@lang ('Do you want to register this reservation information as visit information?')'); return false;">                                                
                                                <i class="fas fa-store-alt icon-register" title="@lang ('elements.words.visit')@lang ('elements.words.register')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endif

                                @can ('authorize', config('permissions.groups.reservations.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('reservations.delete', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('reservations.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
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
</div>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.reservations'), __('elements.words.data'))])</p>
@endif
