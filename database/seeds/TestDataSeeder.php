<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Rate::class, 10000)->create();
        factory(App\Models\User::class, 10000)->create();
    }
}
