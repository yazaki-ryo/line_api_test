<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /** @var string */
    private $table = 'users';

    /** @var string */
    private $name = 'ユーザー';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
                $table->unsignedInteger('role_id')->nullable()->comment('ロールID');

                $table->string('name')->nullable()->comment('名称');
                $table->string('email')->unique()->comment('E-Mail');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles');
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
