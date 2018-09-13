<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admins')->insert([
        'name' => 'Jihad',
        'email' => 'balgohum@gmail.com',
        'password' => bcrypt('345q12345q12'),
      ]);
    }
}
