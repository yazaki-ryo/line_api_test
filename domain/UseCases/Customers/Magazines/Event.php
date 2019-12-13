<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Magazines;

use App\Traits\Database\Transactionable;
use App\Services\DomainCollection;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\MailHistory;

final class Event
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
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return DomainCollection
     */
    public function excute()
    {

        $mailHistories = null;
        // 受信したPOSTの内容をDBに登録する
        $body = file_get_contents('php://input');
        $json = json_decode($body);
        \Log::debug("【受信確認】");
        // DBへの処理
        return $this->transaction(function () use ($json) {
            foreach($json as $event) {
                \Log::debug(print_r($event, true));
                $sgMessageId = $event->sg_message_id;
                if(!empty($sgMessageId)) {
                    $sgMessageIds = explode('.', $sgMessageId); // preg_matchにしたほうがいいかも
                    \Log::debug(print_r($sgMessageIds[0], true));
                    $mailHistories = $this->finder->findAll(['message_id' => $sgMessageIds[0]])->first();
                    \Log::debug(print_r($mailHistories, true));
                    $status = $event->event;
                    $this->finder->update($mailHistories->id(), ['status' => $status]);
                }
                return true;
            }
        });
    }

}
