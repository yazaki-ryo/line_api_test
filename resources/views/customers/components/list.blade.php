@if ($rows->count())
<div class="table-responsive">
    <div class="row">
        <div class="col-md-6">
            @include ('components.parts.page_length_menu')
        </div>
        <div class="col-md-6 text-right form-inline">
          <span>
              @lang('Sort')
          </span>
          <select class="form-control" onchange="customer.sortChange(this)">
              <option value="0" @empty($sorting) selected="selected" @endempty></option>
              <option value="1" @if($sorting == 1) selected="selected" @endif>@lang('Order by visiting count descending')</option>
              <option value="2" @if($sorting == 2) selected="selected" @endif>@lang('Order by visiting count ascending')</option>
          </select>
        </div>
    </div>
    
    <table id="customers-table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid">
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
                <th class="text-center">
                    <input id="select-all" type="checkbox" onclick="common.selectAll();">
                    <!-- <label for="select-all" class="glyphicon glyphicon-check"></label> -->
                </th>
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
                            <label><input type="checkbox" class="selection" name="{{ $attribute = 'selection' }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), old($attribute)) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-center">{{ $row->{$camel = camel_case('last_name')}() }} {{ $row->{$camel = camel_case('first_name')}() }}</td>
                    <td class="text-center">{{ mb_strimwidth($row->{$camel = camel_case('office')}(), 0, 25, '...', 'UTF-8') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('tel')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('mobile_phone')}() }}</td>
                    <td class="text-center"><span class="badge">{{ $row->visitedHistories()->count() }}</span></td>
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

                                        <li>
                                            <a href="{{ route('customers.delete', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('customers.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
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
    @include ('components.parts.page_buttons')
</div>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.customers'), __('elements.words.data'))])</p>
@endif
