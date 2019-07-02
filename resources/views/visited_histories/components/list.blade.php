<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has('selection') ? ' has-error' : '' }}">
    @include ('components.form.err_msg', ['attribute' => 'selection'])
</div>

@if ($rows->count())
    <table id="visited-histories-table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
        <thead>
            <tr>
                <th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.image')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.visited_date')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.visited_time')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.amount')</th>
                <th class="text-center">@lang ('attributes.customers.visited_histories.seat')</th>
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
                    <td class="text-center">
                        @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                            @can ('select', $row)
                                @if(!empty($updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()))
                                    <p class="list-image"><img src="{{ asset(str_finish('storage/' . $updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()->path(), '/') . $updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()->name()) }}" width="100" alt=""></p>
                                @else
                                    <p>画像なし</p>
                                @endif
                            @endcan
                        @endcan
                    </td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('Y-m-d') }}</td>
                    <td class="text-center">{{ empty($row->{$camel = camel_case('visited_at')}()) ? '' : $row->{$camel}()->format('H:i') }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('amount')}() }}</td>
                    <td class="text-center">{{ $row->{$camel = camel_case('seat')}() }}</td>
                    <td class="text-center">
                        <ul class="side-by-side around wrap">
                            @if (! $row->{$camel = camel_case('deleted_at')}())
                                @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                                    @can ('select', $row)
                                        <li>
                                            <a href="{{ route('visited_histories.edit', $row->id()) }}">
                                                <i class="fas fa-pencil-alt icon-edit" title="@lang('elements.words.detail')"></i>
                                            </a>
                                        </li>
                                        @if(!empty($updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()))
                                        <li>
                                            <a href="{{ asset(str_finish('storage/' . $updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()->path(), '/') . $updateVisitedHistory->getVisitedHistory(['id' => $row->id()])->attachments()->first()->name()) }}" target="_blank">
                                                <i class="far fa-file-image" title="@lang('elements.words.image')@lang('elements.words.detail')"></i>
                                            </a>
                                        </li>
                                        @endif
                                    @endcan
                                @endcan

                                @can ('authorize', config('permissions.groups.customers.visited_histories.delete'))
                                    @can ('delete', $row)
                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{{ route('visited_histories.delete', $row->id()) }}" onclick="common.submitFormWithConfirm('{{ route('visited_histories.delete', $row->id()) }}', '@lang ('Do you really want to delete this?')'); return false;">
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
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.histories'), __('elements.words.data'))])</p>
@endif
