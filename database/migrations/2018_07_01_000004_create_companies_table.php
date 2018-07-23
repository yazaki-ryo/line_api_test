<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /** @var string */
    private $table = 'companies';

    /** @var string */
    private $name = '企業';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('plan_id')->nullable()->comment('プランID');
                $table->unsignedInteger('prefecture_id')->nullable()->comment('都道府県ID');

                $table->string('name')->nullable()->comment('名称');
                $table->string('kana')->nullable()->comment('フリガナ');
                $table->string('postal_code')->nullable()->comment('郵便番号');
                $table->text('address')->nullable()->comment('住所');
                $table->text('building_name')->nullable()->comment('建物名');
                $table->string('tel')->nullable()->comment('TEL');
                $table->string('fax')->nullable()->comment('FAX');
                $table->string('email')->nullable()->comment('E-Mail');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('plan_id')
                    ->references('id')
                    ->on('plans');

                $table->foreign('prefecture_id')
                    ->references('id')
                    ->on('prefectures');
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
