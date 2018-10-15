<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="users-table" class="table table-striped table-hover table-condensed table-bordered dt-responsive nowrap dataTable dtr-inline">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('elements.words.human_name')</th>
                <th class="text-center">@lang ('elements.words.role')</th>
                <th class="text-center">@lang ('elements.words.store')</th>
                <th class="text-center">@lang ('elements.words.create')@lang ('elements.words.datetime')</th>
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
                    <td class="text-center">{{ $row->{$camel = camel_case('name')}() }}</td>
                    <td class="text-center">{{ optional($row->{$camel = camel_case('role')}())->name() }}</td>
                    <td class="text-center">{{ optional($row->{$camel = camel_case('store')}())->name() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('created_at')}() }}</td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            @if ($row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.users.restore'))
                                    @can ('restore', $row)
                                        <li>
                                            <a href="{{ route('users.restore', $row->id()) }}" onclick="restoreRecord('{{ route('users.restore', $row->id()) }}'); return false;">
                                                @lang ('elements.words.restore')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan
                            @else
                                @can ('authorize', config('permissions.groups.users.select'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('users.edit', $row->id()) }}">
                                                <i class="fas fa-pencil-alt icon-edit" title="@lang('elements.words.detail')"></i>
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.users.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('users.delete', $row->id()) }}" onclick="deleteRecord('{{ route('users.delete', $row->id()) }}'); return false;">
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
@else
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.users'), __('elements.words.data'))])</p>
@endif
