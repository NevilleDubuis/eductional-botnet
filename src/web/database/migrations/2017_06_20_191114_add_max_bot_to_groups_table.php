<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxBotToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('groups', function (Blueprint $table) {
        $table->integer('max_bot')->unsigned()->default(1);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('groups', function (Blueprint $table) {
        $table->dropColumn('max_bot');
      });
    }
}
