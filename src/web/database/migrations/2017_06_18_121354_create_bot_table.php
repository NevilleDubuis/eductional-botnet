<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bots', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->nullable();
      $table->integer('cpu')->nullable();
      $table->string('mac_address')->unique();
      $table->string('operating_system')->nullable();
      $table->string('state');
      $table->timestamps();
      $table->index('mac_address');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bots');
  }
}
