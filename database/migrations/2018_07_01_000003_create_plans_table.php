<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /** @var string */
    private $table = 'plans';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->comment('プラン名');
                $table->unsignedInteger('price')->default(0)->comment('価格');
                $table->timestamps();
                $table->softDeletes();
            });

            DB::statement(sprintf("ALTER TABLE %s%s COMMENT 'プラン'", DB::getTablePrefix(), $this->table));
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
