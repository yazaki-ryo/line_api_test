@if ($rows->count())
{!! Form::open(['url' => route('customers.deleteMultiple'), 'id' => 'customers-delete-form', 'method' => 'post', 'class' => 'form-horizontal hidden', 'name' => 'customers_delete_form']) !!}
{!! Form::close() !!}
<div class="col-md-12">
    <span id="customers-action-button-wrapper" class="action-btn action-button-wrapper">
        @can ('authorize', config('permissions.groups.customers.postcards.export'))
            <span class="btn btn-success" style="margin-right: 1em;" onclick="showPrintTab()">@lang('Print postcard')</span>
        @endcan
        @can ('authorize', config('permissions.groups.customers.postcards.export'))
            <span class="btn btn-info" style="margin-right: 1em;" onclick="showMailTab()">@lang('Send Mail')</span>
        @endcan
        @can ('authorize', config('permissions.groups.customers.delete'))
            <span class="btn btn-danger" onclick="if (confirm('@lang ('Are you sure delete selected customer(s)?')')) { deleteSelectedCustomers(); }">@lang('Delete selected customers')</span>
        @endcan
    </span>
    <div class="col-md-3 page-length-box">
        @include ('customers.components.page_length_menu')
    </div>
    <div class="col-md-9 text-right form-inline bottom">
        <select class="form-control" onchange="customer.sortChange(this)">
            <option value="0" @empty($sorting) selected="selected" @endempty>@lang('Sort')</option>
            <option value="-1" @if($sorting == -1) selected="selected" @endempty>@lang('Order by created date descending')</option>
            <option value="1" @if($sorting == 1) selected="selected" @endif>@lang('Order by visiting count descending')</option>
            <option value="2" @if($sorting == 2) selected="selected" @endif>@lang('Order by visiting count ascending')</option>
            <option value="3" @if($sorting == 3) selected="selected" @endif>@lang('Order by kana ascending')</option>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive dataTable nowrap no-footer dtr-inline collapsed" role="grid">
        <colgroup>
            <col width="3%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <thead>
            <tr>
                <th class="text-center">
                    <input id="select-all" type="checkbox" onclick="common.selectAll(); selectionChanged();">
                    <!-- <label for="select-all" class="glyphicon glyphicon-check"></label> -->
                </th>
                <th class="text-center">@lang ('elements.words.visited')@lang ('elements.words.num')</th>
                <th class="text-center">@lang ('elements.words.action')</th>
                <th class="text-center">@lang ('elements.words.human_name')</th>
                <th class="text-center">@lang ('attributes.customers.office')</th>
                <th class="text-center">@lang ('attributes.customers.note')</th>
                <th class="text-center">@lang ('attributes.customers.tel')</th>
                <th class="text-center">@lang ('attributes.customers.mobile_phone')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger ' : '' }}">
                    <td class="text-center">
                        <div class="checkbox">
                            <label><input type="checkbox" class="selection" name="{{ $attribute = 'selection' }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), old($attribute)) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            <li>
                                @can ('authorize', config('permissions.groups.customers.update')) 
                                    <a href="{{ route('customers.edit', [$row->id(), 'tab' => 'customers_histories']) }}">
                                        <span class="badge">{{ $row->visitedHistories()->count() }}</span>
                                    </a>
                                @else
                                    <span class="badge">{{ $row->visitedHistories()->count() }}</span>
                                @endcan
                            </li>
                            <li>
                                <a href="{{ route('customers.edit', [$row->id(), 'tab' => 'visited_histories_create_request']) }}">
                                    <i class="fas fa-pencil-alt icon-edit" title="@lang ('elements.words.visit')@lang ('elements.words.register')"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            @if ($row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.customers.restore'))
                                    @can ('restore', $row)
                                        <li>
                                            <a href="{{ route('customers.restore', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('customers.restore', $row->id()) }}', '@lang ('Do you really want to restore this?')'); return false;">
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

                                @can ('authorize', config('permissions.groups.customers.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li class="mobile-hidden">
                                            <a href="{{ route('customers.delete', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('customers.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
                                                <i class="fas fa-trash-alt icon-delete" title="@lang('elements.words.delete')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                            @endif
                        </ul>
                    </td>
                    <td class="text-center">{{ $row->{$camel = camel_case('last_name')}() }} {{ $row->{$camel = camel_case('first_name')}() }}</td>
                    <td class="text-center">{{ mb_strimwidth($row->{$camel = camel_case('office')}(), 0, 20, '...', 'UTF-8') }}</td>
                    <td class="text-center">{{ mb_strimwidth($row->{$camel = camel_case('note')}(), 0, 20, '...', 'UTF-8') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('tel')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include ('components.parts.page_buttons')
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.customers'), __('elements.words.data'))])</p>
@endif
