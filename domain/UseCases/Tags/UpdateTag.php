<?php
declare(strict_types=1);

namespace Domain\UseCases\Tags;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Tag;
use Domain\Models\User;

final class UpdateTag
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param  int $id
     * @return Tag
     * @throws NotFoundException
     */
    public function getTag(int $id): Tag
    {
        if (is_null($resource = $this->finder->find($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param  User $user
     * @param  Tag $tag
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, Tag $tag, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($tag, $args) {
            return $tag->update($args);
        });
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
