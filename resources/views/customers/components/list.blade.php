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
                    <th>@lang ('elements.buttons.action')</th>
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
                            <a href="#" class="btn btn-sm btn-success" title="@lang ('elements.buttons.edit')">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>データがありません。</p>
@endif
