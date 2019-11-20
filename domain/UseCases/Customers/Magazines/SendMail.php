<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Magazines;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\Store;
use Domain\Models\User;

final class SendMail
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
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(array $args): Store
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, Store $store, array $args = [])
    {
        $args = $this->domainize($user, $args);
        
        $ids = [];
        $title = "";
        $content = "";

        // 店舗名を取得
        $storeName = $store->name();

        if(!empty($args['target_customers'])) {
            $ids['customer_ids'] = $args['target_customers'];
        } 

        $title = "【" . $storeName . "からのお知らせ】";

        if(!empty($args['title'])) {
            $title .= " " . $args['title'];
        }

        if(!empty($args['content'])) {
            $content = $args['content'];
        }

        // 顧客情報を取得
        $customers = $store->customers($ids);

        if(!empty($customers)) {

            $tos = [];
            foreach($customers as $key => $customer) {
                $name = $customer->lastName() . " " . $customer->firstName();
                $tos[] = new \SendGrid\Mail\To((string)$customer->email(), $name, ["%name%" => $name, "%storeName%" => $storeName]);
                // ${"personalization_".$key} = new \SendGrid\Mail\Personalization();
                // ${"personalization_".$key}->addTo(new \SendGrid\Mail\To((string)$customer->email(), $name));
                // ${"personalization_".$key}->addSubstitution("%name%", $name);
                // 配信停止タグ： 配信停止は <% こちら %>
                // $email->addPersonalization(${"personalization_".$key});
            }

            $mailDetail = <<<EOL
            <p>%name%様</p>
            <p>%storeName%からのお知らせです。</p><br> 
            <p>$content</p><br><br>
            <p> ------------------------------------------------------------------------ </p>
            <p>配信停止は下記リンクをクリックしてください</p>" .
            <p>↓↓↓</p>
EOL;
            
            $plain = new \SendGrid\Mail\Content("text/plain", "%name%様\n" . $content);
            $html = new \SendGrid\Mail\Content("text/html", $mailDetail);
            $from = new \SendGrid\Mail\From((string)$user->email(), $store->name());

            $email = new \SendGrid\Mail\Mail($from, $tos, $title, $plain, $html);

            try {
                // APIキーをセット
                $sendGrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                $response = $sendGrid->send($email);
                // print $response->statusCode() . "\n";
                // print_r($response->headers());
                // print $response->body() . "\n";
                $this->transaction(function () use ($store, $args) {
                    // 以下にはメールの送信内容を登録する処理を記述
                    // $customer = $store->customer($args);
                });
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
        }

    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        // 

        return $args->all();
    }

    /**
     * @param Customer $customer
     * @param UploadedFile $file
     * @return Attachment
     */
    private function addAttachment(Customer $customer, UploadedFile $file): Attachment
    {
        $attachment = $customer->addAttachment([
            'path' => $path = sprintf('images/attachments/customers/%s', $customer->id()),
            'name' => $name = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName()),
        ]);

        $this->filesystem->disk('public')->putFileAs($path, $file, $name);

        return $attachment;
    }

}
