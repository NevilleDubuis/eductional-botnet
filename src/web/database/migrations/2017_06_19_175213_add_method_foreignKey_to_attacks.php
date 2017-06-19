<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMethodForeignKeyToAttacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('attacks', function (Blueprint $table) {
        $table->integer('method_id')->unsigned();
        $table->foreign('method_id')->references('id')->on('methods')
            ->onDelete('restrict')
            ->onUpdate('restrict');
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
          $table->dropForeign('attacks_method_id_foreign');
      });
    }
}
