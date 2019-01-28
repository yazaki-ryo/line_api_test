<?php
declare(strict_types=1);

namespace Domain\UseCases\VisitedHistories;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Attachment;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

final class UpdateVisitedHistory
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /** @var FilesystemFactory */
    private $filesystem;

    /**
     * @param FindableContract $finder
     * @param FilesystemFactory $factory
     * @return void
     */
    public function __construct(FindableContract $finder, FilesystemFactory $factory)
    {
        $this->finder = $finder;
        $this->filesystem = $factory;
    }

    /**
     * @param  array $args
     * @return VisitedHistory
     * @throws NotFoundException
     */
    public function getVisitedHistory(array $args): VisitedHistory
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param VisitedHistory $visitedHistory
     * @param array $args
     * @param  UploadedFile|null $file
     * @return void
     */
    public function excute(User $user, VisitedHistory $visitedHistory, array $args = [], UploadedFile $file = null): void
    {
        $args = $this->domainize($user, $args);

        $this->transaction(function () use ($visitedHistory, $args, $file) {
            $visitedHistory->update($args);

            if (isset($args['drop_attachment'])) {
                $this->dropAttachments($visitedHistory);
            }

            if (! is_null($file)) {
                $this->addAttachment($visitedHistory, $file);
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

        if ($args->has($key1 = 'visited_date')) {
            $date = $args->get($key1);

            if ($args->has($key2 = 'visited_time') && !is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::parse($date));
        }

        return $args->all();
    }

    /**
     * @param VisitedHistory $visitedHistory
     * @param UploadedFile $file
     * @return Attachment
     */
    private function addAttachment(VisitedHistory $visitedHistory, UploadedFile $file): Attachment
    {
        $attachment = $visitedHistory->addAttachment([
            'path' => $path = sprintf('images/attachments/customers/visited_histories/%s', $visitedHistory->id()),
            'name' => $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName()),
        ]);

        $this->filesystem->disk('public')->putFileAs($path, $file, $name);

        return $attachment;
    }

    /**
     * @param VisitedHistory $visitedHistory
     * @return void
     */
    private function dropAttachments(VisitedHistory $visitedHistory): void
    {
        /** @var Attachment $attachment */
        foreach ($visitedHistory->attachments() as $attachment) {
            $attachment->delete();
            // Per file.
            // $this->filesystem->disk('public')->delete(str_finish($attachment->path(), '/') . $attachment->name());
        }

        // Per directory.
        $this->filesystem->disk('public')->deleteDirectory(sprintf('images/attachments/customers/visited_histories/%s', $visitedHistory->id()));
    }

}
