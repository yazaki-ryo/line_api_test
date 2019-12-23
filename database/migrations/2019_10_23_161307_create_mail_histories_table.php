<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailHistoriesTable extends Migration
{

    /** @var string */
    private $table = 'mail_histories';

    /** @var string */
    private $name = 'メール送信履歴';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
                $table->unsignedInteger('customer_id')->nullable()->comment('顧客ID');
                $table->string('message_id')->nullable()->comment('メッセージID');
                $table->string('title')->nullable()->comment('タイトル');
                $table->text('content')->nullable()->comment('内容');
                $table->string('status')->nullable()->comment('状態');
                $table->timestamps();
                $table->softDeletes();

                // 店舗ID
                $table->foreign('store_id')
                        ->references('id')
                        ->on('stores');

                // 顧客ID
                $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers');

                // DB::statement(sprintf("ALTER TABLE %s%s COMMENT '%s'", DB::getTablePrefix(), $this->table, $this->name));
            });
        } catch (\Exception $e) {
            report($e);
            $this->down();
            dd($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
