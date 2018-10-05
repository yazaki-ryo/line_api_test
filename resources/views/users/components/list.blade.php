<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="users-table" class="table table-striped table-hover table-condensed">
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
                    <td class="text-center dropdown">
                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                        <ul class="dropdown-menu">
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
                                                @lang ('elements.words.detail')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.users.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('users.delete', $row->id()) }}" onclick="deleteRecord('{{ route('users.delete', $row->id()) }}'); return false;">
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
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.users'), __('elements.words.data'))])</p>
@endif
