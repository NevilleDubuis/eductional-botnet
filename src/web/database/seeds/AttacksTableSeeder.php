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
          'start' => Carbon::now('Europe/London')->toDateTimeString(),
          'finish' => Carbon::tomorrow('Europe/London')->toDateTimeString(),
          'user_id' => rand(1,9),
          'method_id' => '1',
          'bots_number' => rand(3568,10000000),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
      }
    }
}
