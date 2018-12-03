<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintSettingsTable extends Migration
{
    /** @var string */
    private $table = 'print_settings';

    /** @var string */
    private $name = '印刷設定';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable()->comment('ユーザーID');
                $table->json('data')->nullable()->comment('データ');
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
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
