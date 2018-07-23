<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use function Illuminate\Foundation\Testing\Concerns\report;

class CreatePermissionUserTable extends Migration
{
    /** @var string */
    private $table = 'permission_user';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->comment('ユーザーID');
                $table->unsignedInteger('permission_id')->comment('権限ID');
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions');
            });

            DB::statement(sprintf("ALTER TABLE %s%s COMMENT 'ユーザー権限'", DB::getTablePrefix(), $this->table));
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
