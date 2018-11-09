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
        factory(App\User::class, 50)->create();
        factory(App\Room::class, 50)->create();
        factory(App\Photo::class, 50)->create();
    }
}
