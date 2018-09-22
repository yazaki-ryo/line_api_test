@if ($rows->count())
    <div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
        {!! $errors->first('selection', '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <table id="customers-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('elements.words.human_name')</th>
                <th class="text-center">@lang ('attributes.customers.office')</th>
                <th class="text-center">@lang ('attributes.customers.tel')</th>
                <th class="text-center">@lang ('attributes.customers.mobile_phone')</th>
                <th class="text-center">@lang ('elements.words.visited')@lang ('elements.words.num')</th>
                <th class="text-center">@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td class="text-center">
                        <div class="checkbox">
                            @set ($attribute, 'selection')
                            <label><input type="checkbox" name="{{ $attribute }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($attribute))) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-center">{{ $row->{$camel = camel_case('last_name')}() }} {{ $row->{$camel = camel_case('first_name')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('office')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('tel')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                    <td class="text-center"><span class="badge">{{ $row->visitedHistories()->count() }}</span></td>
                    <td class="text-center dropdown">
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
                                    @can ('get', $row)
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
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.customers'), __('elements.words.data'))])</p>
@endif
