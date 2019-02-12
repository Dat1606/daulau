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
        factory(App\User::class, 30)->create();
        factory(App\Room::class, 30)->create();
        DB::table('user_rooms')->insert([
            'user_id' => 1,
            'room_id' => 1,
        ]);
    }
}
