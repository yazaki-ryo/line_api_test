<div class="form-group{{ $errors->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="tags-table" class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('elements.words.name')</th>
                <th class="text-center">@lang ('elements.words.customers')@lang ('elements.words.num')</th>
                <th class="text-center">@lang ('elements.words.created')@lang ('elements.words.datetime')</th>
                <th class="text-center">@lang ('elements.words.updated')@lang ('elements.words.datetime')</th>
                <th class="text-center">@lang ('elements.words.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="{{ $row->{$camel = camel_case('deleted_at')}() ? 'danger' : '' }}">
                    <td class="text-center">
                        <div class="checkbox">
                            @set ($attribute, 'selection')
                            <label><input type="checkbox" name="{{ $attribute }}" value="{{ $row->{$camel = camel_case('id')}() }}" {{ !empty(old($attribute)) && in_array($row->{$camel = camel_case('id')}(), explode(',', old($attribute))) ? 'checked' : '' }} {{ $row->{$camel = camel_case('deleted_at')}() ? 'disabled' : '' }} /></label>
                        </div>
                    </td>
                    <td class="text-left"><span class="label label-{{ $row->{$camel = camel_case('label')}() }}">{{ $row->{$camel = camel_case('name')}() }}</span></td>
                    <td class="text-center"><span class="badge">{{ $row->customers()->count() }}</span></td>
                    <td class="text-center">{{ $row->{$camel = camel_case('created_at')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('updated_at')}() }}</td>
                    <td class="text-center dropdown">
                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @if (! $row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.tags.select'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('tags.edit', $row->id()) }}">
                                                @lang ('elements.words.edit')
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.tags.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('tags.delete', $row->id()) }}" onclick="deleteRecord('{{ route('tags.delete', $row->id()) }}'); return false;">
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
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tags'), __('elements.words.data'))])</p>
@endif
