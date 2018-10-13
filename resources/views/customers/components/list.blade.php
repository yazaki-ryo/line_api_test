<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
<div class="table-responsive">
    <table id="customers-table" class="table table-striped table-condensed dt-responsive nowrap dataTable dtr-inline collapsed">
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
                            <label><input type="checkbox" name="{{ $attribute = 'selection' }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($attribute))) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-center">{{ $row->{$camel = camel_case('last_name')}() }} {{ $row->{$camel = camel_case('first_name')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('office')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('tel')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                    <td class="text-center"><span class="badge">{{ $row->visitedHistories()->count() }}</span></td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            @if ($row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.customers.restore'))
                                    @can ('restore', $row)
                                        <li>
                                            <a href="{{ route('customers.restore', $row->id()) }}" onclick="restoreRecord('{{ route('customers.restore', $row->id()) }}'); return false;">
                                                @lang ('elements.words.restore')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan
                            @else
                                @can ('authorize', config('permissions.groups.customers.update'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('customers.edit', $row->id()) }}">
                                                <i class="fas fa-pencil-alt icon-edit" title="@lang('elements.words.detail')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                                    <li>
                                        <a href="{{ route('customers.visited_histories.add', $row->id()) }}">
                                            <i class="far fa-calendar-plus" title="@lang('elements.words.visit')@lang ('elements.words.register')"></i>
                                        </a>
                                    </li>
                                @endcan

                                @can ('authorize', config('permissions.groups.customers.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('customers.delete', $row->id()) }}" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
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
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.customers'), __('elements.words.data'))])</p>
@endif
