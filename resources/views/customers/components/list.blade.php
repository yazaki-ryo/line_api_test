@if ($rows->count())
    <div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
        {!! $errors->first('selection', '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <table id="customers-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th><span class="glyphicon glyphicon-check"></span></th>
                <th>@lang ('elements.words.name')</th>
                <th>@lang ('attributes.customers.office')</th>
                <th>@lang ('attributes.customers.tel')</th>
                <th>@lang ('attributes.customers.mobile_phone')</th>
                <th>@lang ('attributes.customers.visited_cnt')</th>
                <th>@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td>
                        <div class="checkbox">
                            @set ($field, 'selection')
                            <label><input type="checkbox" name="{{ $field }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($field)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($field))) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td>{{ $row->{$camel = camel_case('last_name')}() }} {{ $row->{$camel = camel_case('first_name')}() }}</td>
                    <td>{{ $row->{$camel = camel_case('office')}() }}</td>
                    <td>{{ $row->{$camel = camel_case('tel')}() }}</td>
                    <td>{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                    <td>{{ $row->{$camel = camel_case('visited_cnt')}()->asInt() }}</td>
                    <td class="dropdown">
                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @if ($row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', ['customers.*', 'customers.restore'])
                                    @can ('restore', $row)
                                        <li>
                                            <a href="{{ route('customers.restore', $row->id()) }}" onclick="restoreRecord('{{ route('customers.restore', $row->id()) }}'); return false;">
                                                @lang ('elements.words.restore')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan
                            @else
                                @can ('authorize', ['customers.*', 'customers.update'])
                                    @can ('update', $row)
                                        <li>
                                            <a href="{{ route('customers.edit', $row->id()) }}">
                                                @lang ('elements.words.edit')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', ['customers.*', 'customers.visited_histories.create'])
                                    <li>
                                        <a href="{{ route('customers.visited_histories.add', $row->id()) }}">
                                            @lang ('elements.words.visit')@lang ('elements.words.register')
                                        </a>
                                    </li>
                                @endcan

                                @can ('authorize', ['customers.*', 'customers.delete'])
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('customers.delete', $row->id()) }}" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
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
    <p>@lang ('There is no :name.', ['name' => __('elements.words.data')])</p>
@endif
