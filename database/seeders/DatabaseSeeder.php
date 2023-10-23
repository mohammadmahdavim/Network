<?php

namespace Database\Seeders;

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
        \App\Models\Member::factory(2000)->create();
//        \App\Models\IdentificationCode::factory(1000)->create();
//        $this->call([
//            LevelSeed::class
////            UserIdentificationCode::class
//        ]);
    }
}
