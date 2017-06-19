<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastConnectionAtAndAttackIdToBots extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('bots', function (Blueprint $table) {
      $table->integer('attack_id')->unsigned()->nullable();
      $table->foreign('attack_id')->references('id')->on('attacks');
      $table->timestamp('connected_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('bots', function (Blueprint $table) {
      $table->dropForeign(['attack_id']);
      $table->dropColumn('attack_id');
      $table->dropColumn('connected_at');
    });
  }
}
