<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePrefecturesTable extends Migration
{
    /** @var string */
    private $table = 'prefectures';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 8)->comment('名称');
                $table->timestamps();
                $table->softDeletes();
            });

            DB::statement(sprintf("ALTER TABLE %s%s COMMENT '都道府県'", DB::getTablePrefix(), $this->table));
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
