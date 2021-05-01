<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_histories', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
            $table->unsignedInteger('customer_id')->nullable()->comment('顧客ID');
            $table->unsignedInteger('print_setting_id')->nullable()->comment('印刷設定ID');

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

            // 印刷設定ID
            //$table->foreign('print_setting_id')
            //    ->references('id')
            //    ->on('print_settings');

            // ユニークキー
            $table->unique([
                'store_id',
                'customer_id',
                'print_setting_id',
            ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_histories');
    }
}
