<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPasswdResetsTable extends Migration
{
    /** @var string */
    private $table = 'user_passwd_resets';

    /** @var string */
    private $name = 'パスワードリセット';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
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
