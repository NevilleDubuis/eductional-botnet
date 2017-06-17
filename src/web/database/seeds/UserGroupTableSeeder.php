<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i=1; $i<20;  $i++) {
      $numbers = range(1,9);
      shuffle($numbers);
      $n = rand(3, 6);
      for ($j=1; $j<$n; $j++) {
        DB::table('users_groups')->insert(array(
          'group_id' => $i,
          'user_id' => $numbers[$j]
        ));
      }
    }
  }
}
