<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('methods')->delete();

        DB::table('methods')->insert([
          'name' => 'HTTP Flood (GET)',
        ]);
    }
}
