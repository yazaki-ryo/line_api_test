<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use function Illuminate\Foundation\Testing\Concerns\report;

class CreateUsersTable extends Migration
{
    /** @var string */
    private $table = 'users';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');

                $table->string('name')->comment('名称');
                $table->string('email')->unique()->comment('E-Mail');
                $table->text('code')->comment('ユーザー識別コード');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');
            });

            DB::statement(sprintf("ALTER TABLE %s%s COMMENT 'ユーザー'", DB::getTablePrefix(), $this->table));
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
