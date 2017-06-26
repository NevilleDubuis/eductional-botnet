<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('attacks')->delete();

      /* Création de quelques groupes */
      for ($i=1; $i<4; $i++) {
        DB::table('attacks')->insert([
          'name' => 'Attack_' .$i,
          'target' => '192.168.12.157',
          'port'  => '80',
          'start' => Carbon::now(),
          'finish' => Carbon::tomorrow(),
          'user_id' => rand(1,9),
          'method_id' => '1',
          'bots_number' => rand(358,100000),
          'duration' => 10,
        ]);
      }
    }
}


DB::table('attacks')->insert([
  'name' => 'Attack_1',
  'target' => '192.168.12.157',
  'port'  => '80',
  'user_id' => 1,
  'method_id' => 1,
  'bots_number' => 1,
  'duration' => 1,
]);
