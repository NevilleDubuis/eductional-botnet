<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('attacks', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->string('target')->nullable();
        $table->integer('port');
        $table->datetime('start');
        $table->datetime('finish');
        $table->foreign('method_id')->references('id')->on('methods')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        $table->integer('bots_number');
        $table->timestamps();
      });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('attacks', function (Blueprint $table) {
          $table->dropForeign('attacks_user_id_foreign');
          $table->dropForeign('attacks_method_id_foreign');
      });
      Schema::dropIfExists('attacks');
    }
}
