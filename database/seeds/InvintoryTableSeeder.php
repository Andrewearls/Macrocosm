<?php

use Illuminate\Database\Seeder;

class InvintoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Inventory::class, 10)->create();
    }
}
