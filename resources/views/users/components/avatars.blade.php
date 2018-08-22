@foreach ($row->avatars() as $avatar)
    @continue (! $avatar->name())

    <img src="{{ asset(str_finish('storage/' . $avatar->path(), '/') . $avatar->name()) }}" class="thumbnail" width="150" height="auto" alt="" />
@endforeach
