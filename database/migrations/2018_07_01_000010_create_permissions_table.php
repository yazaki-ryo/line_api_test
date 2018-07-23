<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use function Illuminate\Foundation\Testing\Concerns\report;

class CreatePermissionsTable extends Migration
{
    /** @var string */
    private $table = 'permissions';

    /** @var string */
    private $name = '権限';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->comment('名称');
                $table->string('slug')->unique()->comment('スラッグ');
//                 $table->boolean('auth_company_admin')->default(false)->comment('企業管理者デフォルト');
//                 $table->boolean('auth_store_master')->default(false)->comment('店舗担当者デフォルト');
//                 $table->boolean('auth_general_user')->default(false)->comment('一般ユーザーデフォルト');
                $table->timestamps();
                $table->softDeletes();
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
