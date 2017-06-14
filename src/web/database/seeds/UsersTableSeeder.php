<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'Botnet Admin',
      'email' => 'educational.botnet@gmail.com',
      'password' => bcrypt('adminbotnet'),
      'admin' => true,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
  }
}
