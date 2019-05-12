<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 顧客一覧ソート用インデックス追加
 */
class AddIndexToFuriganaToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->index(['last_name_kana', 'first_name_kana', 'created_at']);
            $table->index(['created_at', 'last_name_kana', 'first_name_kana']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropIndex(['last_name_kana', 'first_name_kana', 'created_at']);
            $table->dropIndex(['created_at', 'last_name_kana', 'first_name_kana']);
        });
    }
}
