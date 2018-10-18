<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /** @var string */
    private $table = 'reservations';

    /** @var string */
    private $name = '予約';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
                $table->unsignedInteger('customer_id')->nullable()->comment('顧客ID');

                $table->timestamp('reserved_at')->nullable()->comment('予約日時');
                $table->string('name')->nullable()->comment('お名前');
                $table->string('seat')->nullable()->comment('席');
                $table->unsignedInteger('amount')->nullable()->comment('人数');
                $table->string('reservation_code')->nullable()->comment('予約コード');
                $table->unsignedTinyInteger('floor')->nullable()->comment('フロア');
                $table->unsignedTinyInteger('status')->nullable()->comment('状態');
                $table->text('note')->nullable()->comment('メモ');

                $table->timestamps();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');

                $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers');
            });

            DB::statement(sprintf("ALTER TABLE %s%s COMMENT '%s'", DB::getTablePrefix(), $this->table, $this->name));
        } catch (\Exception $e) {
            report($e);
            $this->down();
            dd($e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
