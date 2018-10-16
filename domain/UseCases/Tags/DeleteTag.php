<?php
declare(strict_types=1);

namespace Domain\UseCases\Tags;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Tag;
use Domain\Models\User;

final class DeleteTag
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
     * @param  array $args
     * @return Tag
     * @throws NotFoundException
     */
    public function getTag(array $args): Tag
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Tag $tag
     * @return void
     */
    public function excute(User $user, Tag $tag): void
    {
        $this->transaction(function () use ($tag) {
            $tag->delete();
        });
    }

}
