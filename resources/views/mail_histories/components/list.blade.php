@if ($rows->count())
<div class="col-md-12">
    <div class="col-md-3 page-length-box">
        @include ('customers.components.page_length_menu')
    </div>
    <div class="col-md-9 text-right form-inline bottom">
        <select class="form-control" onchange="customer.sortChange(this)">
            <option value="0" @empty($sorting) selected="selected" @endempty>@lang('Sort')</option>
            <option value="-1" @if($sorting == -1) selected="selected" @endempty>@lang('Order by created date descending')</option>
            <option value="3" @if($sorting == 3) selected="selected" @endif>@lang('Order by kana ascending')</option>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable dtr-inline">
        <colgroup>
            <col width="5%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <thead>
            <tr>
                <th class="text-center">@lang ('elements.words.number')</th>
                <th class="text-center">@lang ('elements.words.title')</th>
                <th class="text-center">@lang ('elements.words.content')</th>
                <th class="text-center">@lang ('elements.words.customer')</th>
                <th class="text-center">@lang ('elements.words.status')</th>
                <th class="text-center">@lang ('elements.words.send')@lang ('elements.words.datetime')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td class="text-center">{{ $row->{$camel = camel_case('id')}() }}</td>
                    <td class="text-center">{{ mb_strimwidth($row->{$camel = camel_case('title')}(), 0, 20, '...', 'UTF-8') }}</td>
                    <td class="text-center">{{ mb_strimwidth($row->{$camel = camel_case('content')}(), 0, 20, '...', 'UTF-8') }}</td>
                    <td class="text-center">{{ !empty($row->customer()) ? $row->customer()->lastName() : null }} {{ !empty($row->customer()) ? $row->customer()->firstName() : null }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('status')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('created_at')}() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.mail_history'), __('elements.words.data'))])</p>
@endif
