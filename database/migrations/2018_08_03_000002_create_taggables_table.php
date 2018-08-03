<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use function Illuminate\Foundation\Testing\Concerns\report;

class CreateTaggablesTable extends Migration
{
    /** @var string */
    private $table = 'taggables';

    /** @var string */
    private $name = 'タグ割り付け';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('tag_id')->comment('タグID');
                $table->morphs('taggable');
                $table->timestamps();

                $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags');
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
