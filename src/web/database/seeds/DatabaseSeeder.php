<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $this->call(UsersTableSeeder::class);
    $this->call(GroupsTableSeeder::class);
    $this->call(UserGroupTableSeeder::class);
    $this->call(MethodsTableSeeder::class);
    $this->call(AttacksTableSeeder::class);
  }
}
