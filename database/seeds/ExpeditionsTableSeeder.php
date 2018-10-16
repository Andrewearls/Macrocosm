<?php

use Illuminate\Database\Seeder;

class ExpeditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Expeditions::class, 6)->create();
    }
}
