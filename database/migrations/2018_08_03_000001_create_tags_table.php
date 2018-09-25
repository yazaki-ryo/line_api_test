<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /** @var string */
    private $table = 'tags';

    /** @var string */
    private $name = 'タグ';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
                $table->string('name')->nullable()->comment('名称');
                $table->string('label', 32)->nullable()->comment('ラベル');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');

                $table->unique([
                    'store_id',
                    'name',
                ]);
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
