<?php
declare(strict_types=1);

namespace Domain\UseCases\Settings;

use App\Traits\Database\Transactionable;
use Domain\Models\Avatar;
use Domain\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

final class UpdateProfile
{
    use Transactionable;

    /** @var FilesystemFactory */
    private $filesystem;

    /**
     * @param FilesystemFactory $factory
     * @return void
     */
    public function __construct(FilesystemFactory $factory)
    {
        $this->filesystem = $factory;
    }

    /**
     * @param  User $user
     * @param  array $args
     * @param  UploadedFile|null $file
     * @return void
     */
    public function excute(User $user, array $args = [], UploadedFile $file = null): void
    {
        $args = $this->domainize($user, $args);

        $this->transaction(function () use ($user, $args, $file) {
            $user->update($args);

            if (isset($args['drop_avatar'])) {
                $this->dropAvatars($user);
            }

            if (! is_null($file)) {
                $this->dropAvatars($user);
                $this->addAvatar($user, $file);
            }
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'password')) {
            $args = $args->when(empty($args->get($key)), function (Collection $item) use ($key) {
                return $item->except($key);
            }, function (Collection $item) use ($key) {
                return $item->put($key, bcrypt($item->get($key)));
            });
        }

        return $args->all();
    }

    /**
     * @param User $user
     * @param UploadedFile $file
     * @return Avatar
     */
    private function addAvatar(User $user, UploadedFile $file): Avatar
    {
        $avatar = $user->addAvatar([
            'path' => $path = sprintf('images/avatars/users/%s', $user->id()),
            'name' => $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName()),
        ]);

        $this->filesystem->disk('public')->putFileAs($path, $file, $name);

        return $avatar;
    }

    /**
     * @param User $user
     * @return void
     */
    private function dropAvatars(User $user): void
    {
        /** @var Avatar $avatar */
        foreach ($user->avatars() as $avatar) {
            $avatar->delete();
            // Per file.
            // $this->filesystem->disk('public')->delete(str_finish($avatar->path(), '/') . $avatar->name());
        }

        // Per directory.
        $this->filesystem->disk('public')->deleteDirectory(sprintf('images/avatars/users/%s', $user->id()));
    }
}
