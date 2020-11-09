<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSeatForReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //seatをintに変更 & 外部キー追加
            $table->unsignedInteger('seat')->change();
            $table->foreign('seat')->references('id')->on('seats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //seatをvarcharに戻す & 外部キー削除
            $table->string('seat', 191);
            $table->dropForeign('reservations_seat_foreign');
        });
    }
}
