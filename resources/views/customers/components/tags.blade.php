@forelse ($row->tags() as $tag)
    <span class="label label-{{ $tag->label() }}">{{ $tag->name() }}</span>
@empty
    <p>@lang ('There is no :name.', ['name' => sprintf('%s%s', __('elements.words.tags'), __('elements.words.data'))])</p>
@endforelse
