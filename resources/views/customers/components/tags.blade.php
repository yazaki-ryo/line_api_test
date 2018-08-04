@forelse ($row->tags() as $tag)
    <span class="label label-info">{{ $tag->name() }}</span>
@empty
    <p>@lang ('There is no :name.', ['name' => __('elements.labels.tags')])</p>
@endforelse
