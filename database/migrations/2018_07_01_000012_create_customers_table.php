<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /** @var string */
    private $table = 'customers';

    /** @var string */
    private $name = '顧客';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('store_id')->nullable()->comment('店舗ID');
                $table->unsignedInteger('prefecture_id')->nullable()->comment('都道府県ID');
                $table->unsignedInteger('sex_id')->nullable()->comment('性別ID');
//                 $table->unsignedInteger('group_id')->nullable()->comment('グループID');
//                 $table->unsignedInteger('introducer_id')->nullable()->comment('紹介者ID');

                $table->string('last_name')->nullable()->comment('姓');
                $table->string('first_name')->nullable()->comment('名');
                $table->string('last_name_kana')->nullable()->comment('姓フリガナ');
                $table->string('first_name_kana')->nullable()->comment('名フリガナ');
                $table->string('office')->nullable()->comment('会社名');
                $table->string('office_kana')->nullable()->comment('フリガナ');
                $table->string('department')->nullable()->comment('部署');
                $table->string('position')->nullable()->comment('役職');

                $table->string('postal_code')->nullable()->comment('郵便番号');
                $table->text('address')->nullable()->comment('住所');
                $table->text('building')->nullable()->comment('建物名');
                $table->string('tel')->nullable()->comment('TEL');
                $table->string('fax')->nullable()->comment('FAX');
                $table->string('email')->nullable()->comment('E-Mail');
                $table->string('mobile_phone')->nullable()->comment('携帯電話番号');

                $table->date('birthday')->nullable()->comment('誕生日');
                $table->date('anniversary')->nullable()->comment('記念日');
                $table->timestamp('mourned_at')->nullable()->comment('喪中設定日');

                $table->text('likes_and_dislikes')->nullable()->comment('好き嫌い');
                $table->text('note')->nullable()->comment('メモ');

                $table->unsignedInteger('cancel_cnt')->default(0)->comment('キャンセル回数');
                $table->unsignedInteger('noshow_cnt')->default(0)->comment('ノーショウ回数');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');

                $table->foreign('prefecture_id')
                    ->references('id')
                    ->on('prefectures');

                $table->foreign('sex_id')
                    ->references('id')
                    ->on('sexes');

//                 $table->foreign('group_id')
//                     ->references('id')
//                     ->on('groups');

//                 $table->foreign('introducer_id')
//                     ->references('id')
//                     ->on('introducers');
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
