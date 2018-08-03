@if ($rows->count())
    <div class="table-responsive">
        <table id="customers-table" class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>@lang ('attributes.customers.name')</th>
                    <th>@lang ('attributes.customers.address')</th>
                    <th>@lang ('attributes.customers.tel')</th>
                    <th>@lang ('attributes.customers.mobile_phone')</th>
                    <th>@lang ('attributes.customers.visited_cnt')</th>
                    <th>@lang ('elements.labels.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                        <td>{{ $row->{$camel = camel_case('name')}() }}</td>
                        <td>{{ $row->{$camel = camel_case('address')}() }}</td>
                        <td>{{ $row->{$camel = camel_case('tel')}() }}</td>
                        <td>{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                        <td>{{ $row->{$camel = camel_case('visited_cnt')}()->asInt() }}</td>
                        <td>
                            @if ($row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', ['customers.*', 'customers.restore'])
                                    @can ('restore', $row)
                                        <a href="{{ route('customers.restore', $row->id()) }}" class="btn btn-sm btn-warning" title="@lang ('elements.actions.restore')" onclick="restoreRecord('{{ route('customers.restore', $row->id()) }}'); return false;">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                        </a>
                                    @endcan
                                @endcan
                            @else
                                @can ('authorize', ['customers.*', 'customers.update'])
                                    @can ('update', $row)
                                        <a href="{{ route('customers.edit', $row->id()) }}" class="btn btn-sm btn-success" title="@lang ('elements.actions.edit')">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    @endcan
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>@lang ('There is no :name.', ['name' => __('elements.labels.data')])</p>
@endif
