<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ['name' => 'مهمان', 'rank' => 1],
            ['name' => 'آغازگر', 'rank' => 2],
            ['name' => 'حامی', 'rank' => 3],
            ['name' => 'مشاور', 'rank' => 4],
            ['name' => 'مشاور ارشد', 'rank' => 5],
            ['name' => 'کارشناس', 'rank' => 6],
            ['name' => 'کارشناس ارشد', 'rank' => 7],
            ['name' => 'مدیر', 'rank' => 8],
            ['name' => 'مدیر ارشد', 'rank' => 9],
            ['name' => 'راهبر', 'rank' => 10],
            ['name' => 'راهبر ارشد', 'rank' => 11],
            ['name' => 'استاد', 'rank' => 12],
        ];
        Level::insert($levels);
    }
}
