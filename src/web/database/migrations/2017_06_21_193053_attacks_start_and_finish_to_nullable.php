<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttacksStartAndFinishToNullable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('attacks', function (Blueprint $table) {
      $table->datetime('start')->nullable()->change();
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
      $table->datetime('finish')->change();
    });
  }
}
