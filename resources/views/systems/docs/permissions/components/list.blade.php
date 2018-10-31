<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th class="text-left">#</th>
                {{--<th class="text-center">{{ config('permissions.roles.system.system-admin') }}</th>--}}
                <th class="text-center">{{ config('permissions.roles.general.company-admin') }}</th>
                <th class="text-center">{{ config('permissions.roles.general.store-user') }}</th>
                <th class="text-left">slug</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td class="text-left">{{ $row->name() }}</td>
{{--
                    <td class="text-center">
                        @if ($systemAdmin->containsStrict($row->slug()))
                            <span class="text-success glyphicon glyphicon-ok"></span>
                        @else
                            <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                        @endif
                    </td>
--}}
                    <td class="text-center">
                        @if ($companyAdmin->containsStrict($row->slug()))
                            <span class="text-success glyphicon glyphicon-ok"></span>
                        @else
                            <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($storeUser->containsStrict($row->slug()))
                            <span class="text-success glyphicon glyphicon-ok"></span>
                        @else
                            <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                        @endif
                    </td>
                    <td class="text-left">{{ $row->slug() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tests'), __('elements.words.data'))])</p>
@endif
