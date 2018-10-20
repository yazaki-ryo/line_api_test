<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitedHistoriesTable extends Migration
{
    /** @var string */
    private $table = 'visited_histories';

    /** @var string */
    private $name = '来店履歴';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('customer_id')->nullable()->comment('顧客ID');
                $table->unsignedInteger('reservation_id')->nullable()->comment('予約ID');

                $table->timestamp('visited_at')->nullable()->comment('来店日時');
                $table->string('seat')->nullable()->comment('席');
                $table->unsignedInteger('amount')->nullable()->comment('人数');
                $table->text('note')->nullable()->comment('メモ');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers');

                $table->foreign('reservation_id')
                    ->references('id')
                    ->on('reservations');
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
