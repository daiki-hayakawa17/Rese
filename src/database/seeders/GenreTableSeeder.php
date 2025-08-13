<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'content' => '焼肉',
            ],
            [
                'content' => '居酒屋',
            ],
            [
                'content' => 'イタリアン',
            ],
            [
                'content' => 'ラーメン',
            ],
            [
                'content' => '寿司',
            ],
        ]);
    }
}
