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
        $this->call([
            PositionsTableSeeder::class,
        	UsersTableSeeder::class,
        	InvintoryTableSeeder::class,
            ClassesTableSeeder::class,
            BadgesTableSeeder::class,
            ExpeditionsTableSeeder::class,
        ]);
    }
}
