<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="visited-histories-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.visited_date')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.visited_time')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.amount')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.seat')</th>
                <th class="text-center">@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td class="text-center">
                        <div class="checkbox">
                            @set ($attribute, 'selection')
                            <label><input type="checkbox" name="{{ $attribute }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($attribute))) ? 'checked' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('amount')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('seat')}() }}</td>
                    <td class="text-center dropdown">
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

                            @can ('authorize', ['customers.*', 'customers.visited_histories.delete'])
                                @can ('delete', $row)
                                    <li role="separator" class="divider"></li>

                                    <li>
                                        <a href="{{ route('customers.visited_histories.delete', [$row->customerId(), $row->id()]) }}" onclick="deleteRecord('{{ route('customers.visited_histories.delete', [$row->customerId(), $row->id()]) }}'); return false;">
                                            @lang ('elements.words.delete')
                                        </a>
                                    </li>
                                @endcan
                            @endcan
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.histories'), __('elements.words.data'))])</p>
@endif
