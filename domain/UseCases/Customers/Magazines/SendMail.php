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

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom((string)$user->email(), $store->name());
        $email->setSubject("Sending with SendGrid is Fun");
        // 送信先
        $sendTos = [
            "tsf@togei-sf.co.jp" => "株式会社東迎システムファクトリー",
            "granbashynetmail@gmail.com" => "Granbashy Sound"
        ];

        $email->addTos($sendTos);
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        
        // APIキーをセット
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }

        /*
        $this->transaction(function () use ($store, $args) {
            // 以下にはメールの送信内容を登録する処理を記述
            // $customer = $store->addCustomer($args);
        });
        */
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
