<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())

{!! Form::open(['url' => route('print_histories.deleteMultiple'), 'id' => 'print-histories-delete-form', 'method' => 'post', 'class' => 'form-horizontal hidden', 'name' => 'print_histories_delete_form']) !!}
{!! Form::close() !!}
<div class="col-md-12">
    <span id="histories-action-button-wrapper" class="action-btn action-button-wrapper">
        @can ('authorize', config('permissions.groups.customers.delete'))
            <span class="btn btn-danger delete-btn" onclick="if (confirm('@lang ('Are you sure delete selected print histories?')')) { deleteSelectedPrintHistories(); }">@lang('Delete selected print histories')</span>
        @endcan
    </span>
</div>

    <table id="visited-histories-table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
        <thead>
            <tr>
                <th class="text-center">
                    <input id="select-all" type="checkbox" onclick="common.selectAll(); selectionChanged();">
                </th>
                <th class="text-center">@lang ('attributes.customers.print_histories.setting_name')</th>
                <th class="text-center">@lang ('attributes.customers.print_histories.created_at')</th>
                <th class="text-center">@lang ('attributes.customers.print_histories.updated_at')</th>
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
                    <td class="text-center">
                        @foreach ($printSettings as $key => $item)
                            @if ( $item->id())
                                {{ (int)$row->{$camel = camel_case('print_setting_id')}() === $item->id() ? $item->name() : null }}
                            @else
                                {{ (int)$row->{$camel = camel_case('print_setting_id')}() === (int)$item->{$camel = camel_case('default_setting_id')}() ? $item->name() : null }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('created_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('updated_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.histories'), __('elements.words.data'))])</p>
@endif
