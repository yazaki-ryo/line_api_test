@if ($rows->count())
    <div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
        {!! $errors->first('selection', '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <table id="visited-histories-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th><span class="glyphicon glyphicon-check"></span></th>
                <th>@lang ('attributes.customers.visited_histories.visited_date')</th>
                <th>@lang ('attributes.customers.visited_histories.visited_time')</th>
                <th>@lang ('attributes.customers.visited_histories.amount')</th>
                <th>@lang ('attributes.customers.visited_histories.seat')</th>
                <th>@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>
                        <div class="checkbox">
                            @set ($field, 'selection')
                            <label><input type="checkbox" name="{{ $field }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($field)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($field))) ? 'checked' : '' }} /></label>
                        </div>
                    </td>
                    <td>{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td>{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                    <td>{{ $row->{$camel = camel_case('amount')}() }}</td>
                    <td>{{ $row->{$camel = camel_case('seat')}() }}</td>
                    <td class="dropdown">
                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @can ('authorize', ['customers.*', 'customers.visited_histories.update'])
                                @can ('get', $row)
                                    <li>
                                        <a href="{{ route('customers.visited_histories.edit', [$row->customerId(), $row->id()]) }}">
                                            @lang ('elements.words.edit')
                                        </a>
                                    </li>
                                @endcan
                            @endcan

{{--
                            @can ('authorize', ['customers.*', 'customers.visited_histories.delete'])
                                @can ('delete', $row)
                                    <li role="separator" class="divider"></li>

                                    <li>
                                        <a href="{{ route('customers.visited_histories.delete', [$row->customerId(), $row->id()]) }}" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
                                            @lang ('elements.words.delete')
                                        </a>
                                    </li>
                                @endcan
                            @endcan
--}}
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.histories'), __('elements.words.data'))])</p>
@endif
